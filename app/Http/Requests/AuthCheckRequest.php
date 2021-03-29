<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AuthCheckRequest extends FormRequest
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
            //
        ];
    }

    public function isAuthenticate()
    {
        if (!Auth::check() && $this->path() != 'login') {
            return redirect('/login');
        }
        if (!Auth::check() && $this->path() == 'login') {

            return view('welcome');
        }
        if (Auth::user()->userType == 'User') {
            return redirect('/login');
        }
        if ($this->path() == 'login') {
            return redirect('/');
        }

        return view('welcome');
    }
}
