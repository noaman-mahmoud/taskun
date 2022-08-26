<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\Management\AddProperty;
use App\Http\Requests\Api\Management\EditProperty;
use App\Http\Requests\Api\Management\AddUnit;
use App\Http\Requests\Api\Management\EditUnit;
use App\Repositories\ManagementRepository;
use App\Http\Controllers\Controller;
use App\Models\RealProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\HousingType;
use App\Models\HousingUnit;
use App\Models\EstateType;
use App\Traits\Responses;
use App\Models\UnitDate;
use Carbon\Carbon;
use Validator;
use JWTAuth;
use App;

class ManagementController extends Controller
{
    use Responses;

    private $ManagementRepository;

    public function __construct(ManagementRepository $ManagementRepository)
    {
        $this->ManagementRepository = $ManagementRepository;
    }

    /**  public function estate_types . */
    public function estateTypes()
    {
        $data = EstateType::select('id','name->'. App::getLocale() . ' as name')
                ->where('deleted',0)->latest()->get();

        return $this->responseJsonData($data);
    }

    /**  public function housing_types . */
    public function housingTypes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'estate_type_id' => 'nullable|exists:estate_types,id',
        ]);

        if ($validator->passes()) {

            if (isset($request->estate_type_id))
               $data = HousingType::where(['estate_type_id' => $request->estate_type_id])
                      -> select('id','name->'. App::getLocale() . ' as name')->latest()->get();
            else{
                $data = HousingType::select('id','name->'. App::getLocale() . ' as name')->latest()->get();
            }

            return $this->responseJsonData($data);
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);

    }

    /**  public function add property . */
    public function addProperty(AddProperty $request)
    {
        $dataExcept = Arr::except($request->validated(), ['number_roles']);

        $dataExcept['user_id']      = JWTAuth::toUser()->id;
        $dataExcept['number_roles'] = convert2english($request->number_roles);

        RealProperty::create($dataExcept);

        return $this->responseJsonData([],trans('apis.add_successfully'));
    }

    /**  public function real properties . */
    public function realProperties()
    {
        $JWTUser    = JWTAuth::toUser();
        $properties = RealProperty::where(['user_id'=>$JWTUser->id])->withCount('units')->latest()->get();

        $data = $this->ManagementRepository->properties($properties);

        return $this->responseJsonData($data);
    }

    /**  public function property_details . */
    public function propertyDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required|exists:real_properties,id',
        ]);

        if ($validator->passes()) {

            $JWTUser  = JWTAuth::toUser();
            $property = RealProperty::where(['user_id'=>$JWTUser->id,'id'=>$request->property_id])->withCount('units')
                        ->with(['units','estateType','housingType'])->first();

            if (!isset($property)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $data = $this->ManagementRepository->property_details($property);

            return $this->responseJsonData($data);
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);

    }

    /**  public function edit property . */
    public function editProperty(EditProperty $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required|exists:real_properties,id',
        ]);

        if ($validator->passes()) {

            $JWTUser  = JWTAuth::toUser();
            $property = RealProperty::where(['user_id'=>$JWTUser->id,'id'=>$request->property_id])
                        ->with(['units','estateType','housingType'])->first();

            if (!isset($property)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $data = $this->ManagementRepository->edit_property($request->validated() , $property);

            return $this->responseJsonData($data,trans('apis.successfully_updated'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);

    }

    /**  public function delete property . */
    public function deleteProperty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required|exists:real_properties,id',
        ]);

        if ($validator->passes()) {

            $JWTUser  = JWTAuth::toUser();
            $property = RealProperty::where(['user_id'=>$JWTUser->id,'id'=>$request->property_id])->first();

            if (!isset($property)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $property->delete();

            return $this->responseJsonData([],trans('apis.deleted_successfully'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);
    }

    /**  public function add unit . */
    public function addUnit(AddUnit $request)
    {
        $dataExcept = Arr::except($request->validated(), ['contract_number','electricity_bill','water_bill']);

        $dataExcept['contract_number']  = convert2english($request->contract_number);

        if (isset($request->electricity_bill)){
           $dataExcept['electricity_bill'] = uploadFile($request->electricity_bill,'bills');
        }

        if (isset($request->water_bill)){
            $dataExcept['water_bill'] = uploadFile($request->water_bill,'bills');
        }


        HousingUnit::create($dataExcept);

        return $this->responseJsonData([],trans('apis.add_successfully'));
    }

    /**  public function unit property . */
    public function deleteUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:housing_units,id',
        ]);

        if ($validator->passes()) {

            $unit = HousingUnit::where(['id'=>$request->unit_id])->first();

            if (!isset($unit)){

                return $this->responseJsonError(trans('apis.data_incorrect'));
            }

            $unit->delete();

            return $this->responseJsonData([],trans('apis.deleted_successfully'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);
    }

    /**  public function edit property . */
    public function editUnit(EditUnit $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:housing_units,id',
        ]);

        if ($validator->passes()) {

            $unit = HousingUnit::with('housingType')->where(['id'=>$request->unit_id])->first();

            $data = $this->ManagementRepository->edit_unit($request->validated() , $unit);

            return $this->responseJsonData($data,trans('apis.successfully_updated'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);

    }

    /**  public function unit archive . */
    public function unitArchive(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_id'   => 'required|exists:housing_units,id',
            'archive'   => 'required|in:1,0',
        ],[
            'archive.in' => 'type value [1] [0]',
        ]);

        if ($validator->passes()) {

            $estate = HousingUnit::find($request->unit_id)
                        ->update(['archive'=>$request->archive]);

            return $this->responseJsonData([],trans('apis.successfully_updated'));
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key"=>"fail","msg"=>$error]);
    }

    /**  public function archived units . */
    public function archivedUnits(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_id' => 'required|exists:real_properties,id',
        ]);

        if ($validator->passes()) {

            $units = HousingUnit::where(['property_id'=>$request->property_id,'archive'=>1])
                        ->latest()->get();

            $data  = [];

            foreach ($units as $unit){
              $date    = UnitDate::where('unit_id',$unit->id)->max('date');
              $data [] = [
                  'id'          => $unit->id,
                  'role'        => (int)$unit->role,
                  'archive'     => (int)$unit->archive,
                  'name'        => $unit->name ?? "",
                  'tenant_name' => $unit->tenant_name,
                  'date'        => Carbon::parse($date)->addMonths()->format('Y-m-d'),

              ];
            }

            return $this->responseJsonData($data);
        }

        $error = Arr::first(Arr::flatten($validator->messages()->get('*')));

        return response()->json(["key" => "fail", "msg" => $error]);
    }

    /**  public function unit_message_data . */
    public function unitMessageData()
    {
        $data['send_message'] = (int)setting()['send_message'];
        $data['message_text'] = setting()['message_text'];

        return $this->responseJsonData($data);
    }
}
