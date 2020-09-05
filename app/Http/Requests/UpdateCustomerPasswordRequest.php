<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerPasswordRequest extends FormRequest
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
            'newpass' => 'required|min:8|max:32',
            'renewpass' => 'required|same:newpass'
        ];
    }

    public function messages(){
        return [
            'newpass.required' => 'Mật khẩu không được để trống',
            'newpass.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'newpass.max' => 'mật khẩu có tối đa 32 ký tự',
            'renewpass.same' => 'Mật khẩu không trùng khớp',
            'renewpass.required' => 'Mật khẩu không được để trống'
        ];
    }
}
