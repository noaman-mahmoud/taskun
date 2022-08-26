<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Management\AddProperty;
use App\Http\Requests\Api\Management\EditProperty;
use App\Http\Requests\Api\Management\AddUnit;
use App\Http\Requests\Api\Management\EditUnit;
use App\Repositories\ManagementRepository;
use App\Models\RealProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\HousingType;
use App\Models\HousingUnit;
use App\Models\EstateType;
use App\Models\User;
use Validator;
use Alert;
use Auth;
use App;

class ManagementController extends Controller
{
    private $ManagementRepository;

    public function __construct(ManagementRepository $ManagementRepository)
    {
        $this->ManagementRepository = $ManagementRepository;
    }

    /**  public function property_management . */
    public function propertyManagement()
    {
        $properties = RealProperty::where(['user_id' => Auth::id()])->count();

        if ($properties > 0 ){
            return redirect('real-properties');
        }

        return view('site.management.property_management');
    }

    /**  public function add property . */
    public function addProperty()
    {
        $types   = EstateType::where('deleted',0)->latest()->get();
        $housing = HousingType::latest()->get();

        return view('site.management.add_property', get_defined_vars());
    }

    /**  public function post add property . */
    public function postAddProperty(AddProperty $request)
    {
        $dataExcept = Arr::except($request->validated(), ['number_roles']);

        $dataExcept['user_id']      = Auth::id();
        $dataExcept['number_roles'] = convert2english($request->number_roles);

        RealProperty::create($dataExcept);

        return redirect('real-properties');
    }

    /**  public function real properties . */
    public function realProperties()
    {
        $data = RealProperty::where(['user_id'=>Auth::id()])->withCount('units')->latest()->get();

        $properties = $this->ManagementRepository->properties($data);

        return view('site.management.real_properties',compact('properties'));
    }

    /**  public function property_details . */
    public function propertyDetails($id)
    {
        $user = Auth::user();
        $data = RealProperty::where(['user_id'=>$user->id,'id'=>$id])->withCount('units')
                    ->with(['units','estateType','housingType'])->first();

        if (!isset($data)) { abort(404); }

        $property = $this->ManagementRepository->property_details($data);

        return  view('site.management.property_details', get_defined_vars());
    }

     /** public function edit property
     * ###  wait create page UI ###
     ***/

    public function edit_property(EditProperty $request)
    {
        $property = RealProperty::where(['user_id'=>Auth::id(),'id'=>$request->property_id])
            ->with(['units','estateType','housingType'])->first();

        if (!isset($property)){ abort(404); }

        $data = $this->ManagementRepository->edit_property($request->validated() , $property);

        Alert::seccess(trans('apis.successfully_updated'));

        return back();

    }

    /**  public function delete property . */
    public function delete_property(Request $request)
    {
        $property = RealProperty::where(['user_id'=>Auth::id(),'id'=>$request->property_id])->first();

        if (!isset($property)){ abort(404); }

        $property->delete();

        Alert::success(trans('apis.deleted_successfully'));

        return back();
    }

    /**  public function add unit . */
    public function addUnit($id)
    {
        $user = Auth::user();
        $data = RealProperty::where(['user_id'=>$user->id,'id'=>$id])->first();

        if (!isset($data)) { abort(404);}

        $housing = HousingType::latest()->get();

        return  view('site.management.add_unit', get_defined_vars());
    }

    /**  public function add unit . */
    public function postAddUnit(AddUnit $request)
    {
        if (!isset($request->electricity_bill)){
            Alert::error(trans('site.required_electricity_bill'));
            return  back();
        }

        if (!isset($request->water_bill)){
            Alert::error(trans('site.required_water_bill'));
            return  back();
        }

        $dataExcept = Arr::except($request->validated(), ['contract_number','electricity_bill','water_bill']);

        $dataExcept['contract_number']  = convert2english($request->contract_number);
        $dataExcept['electricity_bill'] = uploadFile($request->electricity_bill,'bills');
        $dataExcept['water_bill']       = uploadFile($request->water_bill,'bills');

        HousingUnit::create($dataExcept);

        Alert::success(trans('apis.added'));

        return redirect('property-details/'.$request->property_id);
    }

    /**  public function unit property . */
    public function deleteUnit(Request $request)
    {
        $unit = HousingUnit::where(['id'=>$request->unit_id])->first();

        if (!isset($unit)){ abort(404);}

        $unit->delete();

        Alert::success(trans('apis.deleted_successfully'));

        return redirect('real-properties');
    }

    /**  public function unit details . */
    public function unitDetails($id,$property)
    {
        $unit = HousingUnit::with('housingType')->where(['id'=>$id,'property_id'=>$property])->first();

        if (! isset($unit)) { abort(404) ;}

        $data = $this->ManagementRepository->unit_details($unit);

        return  view('site.management.unit_details', get_defined_vars());
    }

    /**  public function edit property . */
    public function postEditUnit(EditUnit $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:housing_units,id',
        ]);

        if ($validator->passes()) {

            $unit = HousingUnit::with('housingType')->where(['id'=>$request->unit_id])->first();

            $data = $this->ManagementRepository->edit_unit($request->validated() , $unit);

            Alert::success(trans('apis.successfully_updated'));

            return back();
        }
    }
}
