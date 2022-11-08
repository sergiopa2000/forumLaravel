<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class CreatePostRequest extends FormRequest
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
            'title' => 'post title',
            'idCategory' => 'post category',
            'message' => 'post message'
         ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $categories = Category::all();
        $rule = '';
        foreach ($categories as $category){ 
            if($categories->last() == $category){
                $rule = $rule . $category->id;
            }else{
                $rule = $rule . $category->id . ',';
            }
        }
        
        return [
            'title' => 'required|string|max:60|min:2',
            'idCategory' => 'required|in:'. $rule,
            'message' => 'required|string|min:4'
         ];
    }
    
    public function messages() {
        $required = 'The :attribute field is required';
        $string = 'The :attribute field must be text';
        $max = 'The :attribute must have less than :max characters';
        $min = 'The :attribute must have more than :min characters';
        
        return [
            'title.required' => $required,
            'title.string' => $string,
            'title.max' => $max,
            'title.min' => $min,
            'idCategory.required' => $required,
            'idCategory.in' => 'The selected category must be valid',
            'message.required' => $required,
            'message.string' => $string,
            'message.min' => $min,
        ];
    }
}
