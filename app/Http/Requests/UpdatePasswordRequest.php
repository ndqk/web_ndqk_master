<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'currPass' => 'required|min:6',
            'newPass' => 'required|min:6',
            'reNewPass' => 'required|min:6'
        ];
    }

    public function messages(){
        return [
            'currPass.required' => 'Mật khẩu không được bỏ trống',
            'newPass.required' => 'Mật khẩu không được bỏ trống',
            'reNewPass.required' => 'Mật khẩu không được bỏ trống',
            'currPass.min' => "Mật khẩu phải có ít nhất 6 ký tự",
            'newPass.min' => "Mật khẩu phải có ít nhất 6 ký tự",
            'reNewPass.min' => "Mật khẩu phải có ít nhất 6 ký tự"

        ];
    }
}
