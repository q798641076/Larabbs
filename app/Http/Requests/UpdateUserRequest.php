<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    protected $errorBag='update';
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
            'name'=>'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'.Auth::id(),
            'email'=>'required|email|unique:users,email,'.Auth::id(),
            'avatar'=>'image',
            'introduction'=>'max:80',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'名字不能为空',
            'name.between'=>'名字在3-25字符之间',
            'name.regex'=>'名字含有特殊字符',
            'name.unqiue'=>'名字已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不对',
            'introduction.max'=>'个人简历不能超过80字符'
        ];
    }
}
