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
            // 'name.required' => 'Name is required!',
            // 'password.required' => 'Password is required',
            // 'account.required' => 'Username is required',
            //'repassword.same'  => 'Not match',
        ];
    }
}
