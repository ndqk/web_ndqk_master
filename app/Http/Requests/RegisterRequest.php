<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers',
            'password' => 'required|min:8|max:32',
            'repassword' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã được sử dụng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu có tối đa 32 ký tự',
            'repassword.required' => 'Xác nhận mật khẩu',
            'repassword.same' => 'Mật khẩu không trùng khớp'
        ];
    }
}
