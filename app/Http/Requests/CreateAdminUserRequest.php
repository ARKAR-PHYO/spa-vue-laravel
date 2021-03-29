<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminUserRequest extends FormRequest
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
            'fullName' => 'required',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
            'userType' => 'required',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'fullName.required' => 'Full Name Cannot Be Blank'
    //     ]
    // }
}
