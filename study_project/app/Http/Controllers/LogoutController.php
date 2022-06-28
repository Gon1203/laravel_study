<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * 로그아웃 유저 계정
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function perform(){
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
