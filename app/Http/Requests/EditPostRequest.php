<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends CreatePostRequest{

    public function rules()
    {
        session()->flash('idPost', $this->post->id);
        $rules = parent::rules();
        return $rules;
    }
}