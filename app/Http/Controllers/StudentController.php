<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    //todo: scholar login form
    public function login_form()
    {
        return view('student/login-form');
    }

    //todo: admin login functionality
    public function login_functionality(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);


        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('student.home');
        }else{
            flash()
                ->option('position', 'top-center')
                ->option('timeout', 3000)
                ->addWarning('Your account may not have been reactivated.');
            return back();
        }
    }

    public function dashboard()
    {
        return view('student.home');
    }


    //todo: admin logout functionality
    public function logout(){
        Auth::guard('student')->logout();
        return redirect()->route('student.login-form.blade.php');
    }
}