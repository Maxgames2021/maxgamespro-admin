<?php

namespace App\Http\Controllers;

use App\HttpClientExtension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class MainController extends Controller
{
    public function Index()
    {
        if(Session::has('refresh_token'))
        {
            return redirect('home');
        }
        else return view('login');
    }

    public function Login(Request $request)
    {
        $requestData = ['username' => $request->username,
                        'password' => $request->password];
        $response = HttpClientExtension::CreateToken($requestData);
        if ($response) {
            return redirect('home');
        }
        // return Redirect::back()->withErrors(['msg', 'The Message']);
        // @if($errors->any())
        // <h4>{{$errors->first()}}</h4>
        // @endif
        return back()->with('error', 'login failed!');
    }

    public function Logout(Request $request)
    {
        Session::flush();
        return redirect('/');
    }
}
