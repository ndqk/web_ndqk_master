<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'date' => 'required',
            'user' => 'required',
            'content' => 'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Title không được bỏ trống',
            'date.required' => 'Deadline không được bỏ trống',
            'user.required' => 'Phải có ít nhất 1 người thực hiện',
            'content.required' => 'Nội dung việc không được bỏ trống'
        ];
    }
}
