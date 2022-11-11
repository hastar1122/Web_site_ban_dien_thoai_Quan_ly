<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'oldpassword' => 'required',
            'newpassword' => 'required|alpha_num',
            'confirm_newpassword'  => 'required|alpha_num|same:newpassword',
        ];
    }
    public function messages()
    {
        return [
            'oldpassword.required' => 'Không được bỏ trống !',
            'newpassword.required' => 'Không được bỏ trống !',
            'confirm_newpassword.required' => 'Không được bỏ trống !',
            'confirm_newpassword.same'  => 'Mật khẩu không khớp !',
        ];
    }
    
}
