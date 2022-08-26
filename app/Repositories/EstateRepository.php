<?php

namespace App\Repositories;
use App\Models\EstateFeature;
use App\Models\EstateAddition;
use App\Models\EstateContact;
use App\Models\EstateImage;
use Illuminate\Support\Arr;
use App\Traits\Responses;
use App\Models\Comment;
use App\Models\Addition;
use App\Models\Option;
use App\Models\Estate;
use App\Models\Feature;
use App\Models\Like;
use Carbon\Carbon;
use Validator;
use App;
use DB;

class EstateRepository
{
    use Responses;

    /**  public function estates. */
    public function estates($estates)
    {
        $data    = [];
        foreach ($estates as $estate){

            $data [] = [
                'id'        => $estate->id,
                'image'     => $estate->estateImage->image,
                'title'     => $estate->title,
                'lat'       => $estate->lat,
                'lng'       => $estate->lng,
                'address'   => $estate->address,
                'price'     => isset($estate->price) ? $estate->price : '',
                'sale_type' => trans('apis.'.$estate->sale_type),
                'type'      => trans('apis.'.$estate->type),
                'archive'   => (int)$estate->archive,
                'views'     => (int)$estate->views,
                'likes'     => isset($estate->likes) ? $estate->likes->sum('count') : 0 ,
                'distance'  => isset($estate->distance) ? (int)$estate->distance : 0,
                'created'   => $estate->updated_at->format('d-m-Y'),
            ];
        }

        return $data;
    }

    /**  public function estate details . */
    public function estate_details($estate)
    {
        $features  = EstateFeature::with(['option','feature'])->where(['estate_id'=>$estate->id])->latest()->get();
        $additions = EstateAddition::with(['addition'])->where(['estate_id'=>$estate->id])->latest()->get();

        $dataFeatures = [];
        foreach ($features as $feature){
            $dataFeatures [] = [
                'image'  => $feature->feature->image,
                'name'   => $feature->feature->feature,
                'value'  => isset($feature->option_id) ? $feature->option->name : $feature->value,
            ];
        }

        $dataAdditions = [];
        foreach ($additions as $addition){
            $dataAdditions [] = [
                'image'  => $addition->addition->image,
                'name'   => $addition->addition->name,
            ];
        }

        $images    = EstateImage::where('estate_id',$estate->id)->pluck('image')->toArray();
        $contacts  = EstateContact::where('estate_id',$estate->id)->pluck('phone')->toArray();

        $data ['images']          = $images;
        $data ['id']              = $estate->id;
        $data ['is_favorite']     = $this->is_favorite($estate->id);
        $data ['share']           = url('details-estate/'.$estate->id);
        $data ['created']         = $estate->created_at->diffforhumans();
        $data ['views']           = $estate->views;
        $data ['likes']           = isset($estate->likes) ? $estate->likes->sum('count') : 0;
        $data ['type']            = trans('apis.'.$estate->type);
        $data ['sale_type']       = trans('apis.'.$estate->sale_type);
        $data ['archive']         = (int)$estate->archive;
        $data ['title']           = $estate->title;
        $data ['city']            = $estate->city->name;
        $data ['address']         = $estate->address;
        $data ['lat']             = $estate->lat;
        $data ['lng']             = $estate->lng;
        $data ['price']           = isset($estate->price) ? (string)$estate->price : '';
        $data ['features']        = $dataFeatures;
        $data ['category']        = $estate->category->name;
        $data ['estate_category'] = $estate->estateCategory->name;
        $data ['neighborhood']    = $estate->neighborhood;
        $data ['description']     = isset($estate->description) ? $estate->description : '';
        $data ['additions']       = $dataAdditions;
        $data ['whatsapp']        = $estate->whatsapp;
        $data ['phones']          = $contacts;
        $data ['username']        = isset($estate->username)      ? $estate->username      : '';
        $data ['user_whatsapp']   = isset($estate->user_whatsapp) ? $estate->user_whatsapp : '';
        $data ['user_phone']      = isset($estate->user_phone)    ? $estate->user_phone    : '';

        return $data;
    }

    /**  public function edit estate . */
    public function edit_estate($updateRequests ,$estate)
    {
        ### data except from Requests
        $requests  = Arr::except($updateRequests,[
            'images','estate_id','delete_images','features','additions','phones'
         ]);

        $result = array_filter($requests);

        empty($requests) ? $result : $estate->update($result);

        ### create images
        if (isset($updateRequests['images'])){

            foreach ($updateRequests['images'] as $image){
                EstateImage::create([
                    "estate_id" => $estate->id,
                    "image"     => uploadFile($image,'estate_images'),
                ]);
            }
        }

        ### delete images with separator [,]
        if (isset($updateRequests['delete_images'])){

            $delete_ids = explode(',',$updateRequests['delete_images']);

            foreach ($delete_ids as $delete){

                $EstateImage = EstateImage::find((int)$delete);

                isset($EstateImage) ?  $EstateImage->delete() : null;
            }
        }

        ### edit addition
        if (isset($updateRequests['additions'])){

            $this->edit_addition($updateRequests['additions'] , $estate );
        }

        ### update contacts
        if (isset($updateRequests['phones'])){

            $this->edit_contacts($updateRequests['phones'] , $estate );
        }

        ### update features
        if (isset($updateRequests['features'])){

            $this->update_features($updateRequests['features'] , $estate );
        }

        $additions = Addition::latest()->get();
        $dataAdditions = [];

        foreach ($additions as $addition){

            $checked = EstateAddition::where(['estate_id'=>$estate->id,'addition_id'=>$addition->id])->first();

            $dataAdditions [] = [
                'id'      => $addition->id,
                'image'   => $addition->image,
                'name'    => $addition->name,
                'checked' => isset($checked) ? 1 : 0,
            ];
        }

        $images    = EstateImage::where('estate_id',$estate->id)->select('id','image')->get();
        $contacts  = EstateContact::where('estate_id',$estate->id)->select('id','phone')->get();

        $data ['images']             = $images;
        $data ['type']               = $estate->type;
        $data ['type_name']          = trans('apis.'.$estate->type);
        $data ['sale_type_name']     = trans('apis.'.$estate->sale_type);
        $data ['sale_type']          = $estate->sale_type;
        $data ['title']              = $estate->title;
        $data ['city_id']            = (int)$estate->city_id;
        $data ['city']               = $estate->city->name;
        $data ['address']            = $estate->address;
        $data ['lat']                = $estate->lat;
        $data ['lng']                = $estate->lng;
        $data ['price']              = isset($estate->price) ? (string)$estate->price : '';
        $data ['category_id']        = (int)$estate->category_id;
        $data ['category']           = $estate->category->name;
        $data ['estate_category_id'] = (int)$estate->estate_category_id;
        $data ['entrustment']        = isset($estate->entrustment) ? $estate->entrustment : '';
        $data ['estate_category']    = $estate->estateCategory->name;
        $data ['neighborhood']       = $estate->neighborhood;
        $data ['planned']            = isset($estate->planned) ? $estate->planned : '';
        $data ['features']           = $this->get_features($estate);
        $data ['additions']          = $dataAdditions;
        $data ['description']        = $estate->description;
        $data ['whatsapp']           = $estate->whatsapp;
        $data ['phones']             = $contacts;
        $data ['username']           = isset($estate->username)      ? $estate->username      : '';
        $data ['user_whatsapp']      = isset($estate->user_whatsapp) ? $estate->user_whatsapp : '';
        $data ['user_phone']         = isset($estate->user_phone)    ? $estate->user_phone    : '';

        return $data;
    }

    /**  public function estates search . */
    public function estates_search($requests , $query)
    {
        if (isset( $requests['city_id'] )){

            $query->where('city_id',$requests['city_id']);
        }

        if (isset( $requests['type'] )){

            $query->where('type',$requests['type']);
        }

        if (isset( $requests['sale_type'] )){

            $query->where('sale_type',$requests['sale_type']);
        }

        if (isset( $requests['category_id'] )){

            $query->where('category_id',$requests['category_id']);
        }

        if (isset( $requests['estate_category_id'] )){

            $query->where('estate_category_id',$requests['estate_category_id']);
        }

        if (isset( $requests['search'] )){

            $query->where('title', 'LIKE', '%' . $requests['search'] . '%');
        }

        return $query;
    }

    /**  public function estates filter . */
    public function estates_filter($requests , $query)
    {
        # [ sell , rent]
        if (isset( $requests['type'] )){
            $query->where('type',$requests['type']);
        }

        if (isset($requests['estate_category_id'])){
            $query->where('estate_category_id',$requests['estate_category_id']);
        }

        if (isset($requests['category_id'])){
            $query->where('category_id',$requests['category_id']);
        }

        if (isset($requests['year'])){
            $query->whereYear('created_at', '=',$requests['year']);
        }

        if (isset($requests['created']) && (int)$requests['created'] > 1){
            $date = Carbon::now()->subDays($requests['created']);
            $query->where('created_at', '>=', $date);
        }

        ## [ som , limit]
        if (isset($requests['sale_type'])){
            $query->where('sale_type',$requests['sale_type']);
        }

        ## Filter between price from and price to
        if (isset($requests['price_from']) && isset($requests['price_to'])) {

            $query->whereBetween('price', [ (int)$requests['price_from'], (int)$requests['price_to'] ]);
        }

        ##  check if request feature
        if (isset($requests['features'])){

            $features = json_decode($requests['features'],true);

            $filter   = [];

            foreach ($features as $value){

                $value_from = isset($value['from']) ? $value['from'] : $value['value'];
                $value_data = $value['value'];
                $feature    = $value['feature_id'];

                $result = DB::select("SELECT * FROM estate_features WHERE feature_id = $feature
                          AND ( value BETWEEN $value_from AND $value_data )");

                $filter [] = [ $result ];
            }

            $items = Arr::flatten($filter);

            $ids   = collect($items)->pluck('estate_id','estate_id')->toArray();

            $query->whereIn('id',$ids);
        }

        if (isset($requests['additions'])){

            $additions  = explode("," ,$requests['additions']);

            $estate_ids = EstateAddition::whereIn('addition_id',$additions)->pluck('estate_id')->toArray();

            $query->whereIn('id',$estate_ids);
        }

        return $query;
    }

    /**  public function edit addition . */
    public function edit_addition($additions , $estate)
    {
        $data_addition = [];
        foreach (explode(',',$additions) as $addition){

            $data = EstateAddition::updateOrCreate(
                ['estate_id' => $estate->id , 'addition_id'=>$addition] , ['addition_id' => $addition]
            );

            $data_addition [] = [$data->id];
        }

        EstateAddition::where(['estate_id'=>$estate->id])->whereNotIn('id',$data_addition)->delete();
    }

    /**  public function edit contacts . */
    public function edit_contacts($contacts , $estate)
    {
        $data_contact = [];
        foreach (explode(',',$contacts) as $contact){

            $phone = EstateContact::updateOrCreate(
                ['estate_id' => $estate->id , 'phone'=>$contact] , ['phone' => $contact]
            );

            $data_contact [] = [$phone->id];
        }

       EstateContact::where(['estate_id'=>$estate->id])->whereNotIn('id',$data_contact)->delete();

    }

    /**  public function get features . */
    public function get_features($estate)
    {
        $features = Feature::get();

        $data_features     = [];

        foreach ($features as $feature){

            $estate_feature = EstateFeature::where(['estate_id'=>$estate->id,'feature_id'=>$feature->id])->first();
            $options        = Option::where(['feature_id'=>$feature->id])->get();

            $options_data   = [];

            foreach ($options as $option){

                $options_data [] = [
                    'id'    => $option->id,
                    'name'  => $option->name,
                    'value' => isset($option->value) ? $option->value : '',
                ];
            }

            $check_option      = isset($estate_feature->option_id) ? $estate_feature->option->name : '';

            $data_features []  = [
                'id'          => $feature->id,
                'name'        => $feature->feature,
                'type'        => $feature->type->type,
                'options'     => isset($options) ? $options_data : [],
                'value'       => isset($estate_feature) ? $estate_feature->value : '',
                'value_id'    => isset($estate_feature) ? $check_option : '',
            ];
        }

        return $data_features;
    }

    /**  public function update features . */
    public function update_features($features,$estate)
    {
        $Features_    = json_decode($features,true);
        $data_feature = [] ;

        foreach ($Features_ as $value){

            $feature =  EstateFeature::updateOrCreate([
                'estate_id'   => $estate->id,
                'feature_id'  => $value['feature_id'],
                'option_id'   => in_array($value['type'],['radio','select']) ? $value['value'] : null,
                'type'        => $value['type'],
                'value'       => $value['value'],
            ]);

            $data_feature [] = ['EstateFeatureId'=> $feature->id];
        }

        EstateFeature::where(['estate_id'=>$estate->id])->whereNotIn('id',$data_feature)->delete();
    }
}
