<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;


class RegisterController extends Controller
{
    # 회원가입 페이지 디스플레이
    public function show(){
        return view('auth.register');
    }

    # 회원가입 request
    public function register(RegisterRequest $request){
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect('/')-> with('success', "Account successfully registered.");
    }
}
