<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signupPage(){
        if (Auth::check()) return redirect(route('account'));
        return view('signup');
    }

    public function signup(Request $request){
        if (Auth::check()) return redirect(route('account'));

        $validateFields = $request -> validate([
           'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:6',             // must be at least 6 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
//                'regex:/[A-Z]/',      // must contain at least one uppercase letter
//                'regex:/[0-9]/',      // must contain at least one digit
//                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
//            'password_confirm' => 'required|same:password',
        ]);

        if (User::where('email', $validateFields['email'])-> exists()){
            return redirect(route('signup'))->withErrors([
                'email' => 'This email is already reserved'
            ]);
        }

        if (User::where('name', $validateFields['name'])-> exists()){
            return redirect(route('signup'))->withErrors([
                'name' => 'This name is already reserved'
            ]);
        }

        $user = User::create($validateFields);
        if ($user){
            Auth::login($user);
            return redirect(route('account'));
        }

        return redirect(route('signup'))->withErrors([
            'formError' => 'Error with user saving'
        ]);
    }

    public function loginPage(){
        if (Auth::check()) return redirect(route('account'));
        return view('login');
    }

    public function login(Request $request){
        if (Auth::check()) return redirect(route('account'));

        $formFields = $request -> only(['email', 'password'] );

        if (Auth::attempt($formFields)){
            return redirect(route('account'));
        }

        return redirect(route('login')) -> withErrors([
           'formError' => "Authorization couldn't be completed",
        ]);

    }
}
