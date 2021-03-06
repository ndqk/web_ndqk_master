<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'title' => 'required',
            'link' => 'required',
            'image' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Title không được để trống',
            'link.required' => 'Link không được để trống',
            'image.required' => 'Ảnh không được để trống'
        ];
    }
}
