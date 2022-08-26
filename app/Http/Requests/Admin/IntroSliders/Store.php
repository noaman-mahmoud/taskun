<?php

namespace App\Http\Requests\Admin\IntroSliders;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->getMethod() === 'PUT'){
            return [
                'image'          => 'nullable|image' , 
                'title_ar'       => 'required' , 
                'title_en'       => 'required' , 
                'description_ar' => 'required' , 
                'description_en' => 'required' , 
            ];
        }else{
            return [
                'image'          => 'required|image' , 
                'title_ar'       => 'required' , 
                'title_en'       => 'required' , 
                'description_ar' => 'required' , 
                'description_en' => 'required' , 
            ];
        }
       
    }
}
