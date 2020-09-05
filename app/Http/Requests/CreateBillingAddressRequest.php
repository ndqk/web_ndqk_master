<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBillingAddressRequest extends FormRequest
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
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street_address' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'street_address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'email.required' => 'Email không được để trống' 
        ];
    }
}
