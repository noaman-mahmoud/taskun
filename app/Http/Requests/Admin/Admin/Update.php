<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [

            'name'      => 'required|max:191',
            'phone'     => "required|min:10|unique:users,phone,".$this->id,
            'email'     => "required|email|max:191|unique:users,email,".$this->id,
            'password'  => 'nullable|min:6',
            'avatar'    => 'nullable|image',
            'role_id'   => 'required|exists:roles,id',
            'active'    => 'nullable|in:1,0',
            'block'     => 'required|in:1,0',
        ];
    }
}
