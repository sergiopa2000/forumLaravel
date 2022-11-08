<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends UserCreateRequest{

    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = 'required|string|max:60|min:2|unique:user,name,'. $this->user->id;
        $rules['email'] = 'required|email|max:50|min:6|unique:user,email,'. $this->user->id;
        $rules['birthdate'] = '';
        return $rules;
    }
}