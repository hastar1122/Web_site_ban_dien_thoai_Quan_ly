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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'account' => 'required|alpha_num',
            'password'  => 'required|alpha_num',
            'repassword'  => 'required|same:password|alpha_num',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được bỏ trống họ tên !',
            'password.required' => 'Không được bỏ trống mật khẩu !',
            'account.required' => 'Không được bỏ trống tài khoản !',
            'repassword.same'  => 'Mật khẩu không khớp !',
        ];
    }
}
