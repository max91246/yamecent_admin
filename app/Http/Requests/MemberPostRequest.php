<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberPostRequest extends FormRequest
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
            'name' => 'required',
            'nickname' => 'required',
            'account' => 'required',
            'password' => 'required',
            'email' => 'email'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '姓名不能為空',
            'nickname.required'  => '綽號不能為空',
            'account.required' => '帳號不能為空',
            'password.required'  => '密碼不能為空',
            'email.email'  => 'email格式有問題'
        ];
    }
}
