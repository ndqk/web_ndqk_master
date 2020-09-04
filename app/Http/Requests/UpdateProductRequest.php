<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => 'required',
            'type' => 'required',
            'description' => 'required',
            'size' => 'required',
            'color' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'price.required' => 'Đơn giá không được để trống',
            'type.required' => 'Sản phẩm dành cho không được để trống',
            'description.required' => 'Mô tả sản phẩm không được để trống',
            'size.required' => 'Kích cỡ sản phẩm không được để trống',
            'color.required' => 'Màu của sản phẩm không được để trống'
        ];
    }
}
