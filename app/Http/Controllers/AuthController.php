<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function __login(Request $request){

        if($request->except('_token')) {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];
            if(Auth::attempt($credentials)){
                return redirect(URL::to('/'))->with('message', 'Berhasil Login. Selamat Datang!');
            }else{
                return redirect(URL::to('/login'))->with('error', 'Username/Password salah');
            }
        }else{
            return redirect(URL::to('/login'))->with('error', 'Masukan Username/Password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(URL::to('/login'))->with('success', 'Berhasil Logout. See You :)');

    }
}
