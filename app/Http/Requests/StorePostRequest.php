<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string',
            'category' => 'required',
            'previewImage' => 'required',
            'content' => 'required',
            'status' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Title không được để trống',
            'category.required' => 'Category không được để trống',
            'previewImage.required' => 'Ảnh không được để trống',
            'content.required' => 'Content không được để trống',
            'status.required' => 'Status không được để trống'
        ];
    }
}
