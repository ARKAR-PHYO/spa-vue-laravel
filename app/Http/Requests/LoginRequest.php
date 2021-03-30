<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ];
    }

    public function loginCheck()
    {
        if (Auth::attempt($this->only('email', 'password'))) {
            if (Auth::user()->role->isAdmin == 0) {
                Auth::logout();
                return response()->json([
                    'msg' => 'You are not allow'
                ], 401);
            }
            return response()->json([
                'msg' => 'Login Success',
                // 'user' => Auth::user()
            ]);
        }else{
            return response()->json([
                'msg' => 'Login detail are incorrect'
            ], 401);
        }
    }


}
