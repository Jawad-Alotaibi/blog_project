<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
public function showCorrectHomePage()
    {
        if(Auth::check())
        {
            return view('homepage-feed');
        } else
        {
            return view('homepage');
        }
    }


    public function register(Request $request) 
    {
        $incomingFields = $request->validate([
            'username'=> ['required', 'min:3', 'max:20', Rule::unique('users','username')],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password'=> ['required', 'min:8', 'confirmed']
        ]);
        $user = User::create([
            'username' => $incomingFields['username'],
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password']
        ]);
        //logged them before redirect them to the auth home page
         Auth::login($user);
        return redirect('/')->with('success','Thank you for creating an account');
    }

     public function getRegisterPage()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);
        
        if(Auth::attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) { //if the credintials are true        {
            $request->session()->regenerate(); // give the user session value, to tell the browser to store it in a cookie and then that way the browser will send this information with each request
            return redirect('/')->with('success', 'You have successfully logged in');
        } else{
            return redirect('/login')->with('failure', 'Invalid login');

        }
    }
     // fares best FormOps in eye of salman
     public function getLoginPage()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You are now logged out');
    }

}
