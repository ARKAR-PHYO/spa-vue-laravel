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
        $user = Auth::user();
        if ($user->userType == 'User') {
            return redirect('/login');
        }
        if ($this->path() == 'login') {
            return redirect('/');
        }

        return $this->checkForPermission($user);
        return view('errors.notfound');
        return view('welcome');
    }
    public function checkForPermission($user)
    {
        $permission = json_decode($user->role->permission);
        $hasPermission = false;
        foreach($permission as $p){
            if ($p->name == $this->path()) {
                if ($p->read) {
                    $hasPermission = true;
                }
            }
        }
        if ($hasPermission) return view('welcome');
        return view('errors.notfound');

    }

}
