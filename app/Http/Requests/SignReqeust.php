<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignReqeust extends FormRequest
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
        return [
            'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'summary'=>'required|min:10|max:400',
            'address'=>'required',
            'name'=>'required|min:6',
            'password'=>'required|min:6',  
        ];
    }
}
