<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
    
    function attributes(){
         return [
            'name' => 'username',
            'email' => 'email',
            'birthdate' => 'birthdate',
         ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:60|min:2|unique:user,name',
            'email' => 'required|email|max:50|min:6|unique:user,email',
            'birthdate' => 'required|date',
         ];
    }
    
    public function messages() {
        $required = 'The :attribute field is required';
        $string = 'The :attribute field must be text';
        $max = 'The :attribute field must have less than :max characters';
        $min = 'The :attribute field must have more than :min characters';
        
        return [
            'name.required' => $required,
            'name.string' => $string,
            'name.max' => $max,
            'name.unique' => 'A user with that name already exists',
            'name.min' => $min,
            'email.required' => 'The :attribute field must be an email',
            'email.string' => $string,
            'email.max' => $max,
            'email.min' => $min,
            'email.unique' => 'This email has already been registered',
            'birthdate.required' => $required,
            'birthdate.date' => 'The :attribute field must be a date',
        ];
    }

}
