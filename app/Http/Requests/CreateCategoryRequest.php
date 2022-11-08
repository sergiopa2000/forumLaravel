<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'category name',
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
            'name' => 'required|string|max:20|min:2|unique:category,name',
         ];
    }
    
    public function messages() {
        $required = 'The :attribute field is required';
        $string = 'The :attribute field must be text';
        $max = 'The :attribute must have less than :max characters';
        $min = 'The :attribute must have more than :min characters';
        
        return [
            'name.required' => $required,
            'name.string' => $string,
            'name.max' => $max,
            'name.min' => $min,
            'name.unique' => 'A category with that name already exists',
        ];
    }
}
