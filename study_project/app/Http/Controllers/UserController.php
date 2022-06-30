<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newUsers = User::latest() -> simplePaginate(5);

        return view('newUser.index', compact('newUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newUser.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create($request->all());

        return redirect()->route('newuser.index')
            ->with('success', 'New User created successfully!');
        //
    }

    /**
     * Display the specified resource.
     * email을 키값으로 newUser를 검색하여 뷰 페이지에 반환
     * @param  \App\Models\User  String $email
     * @return \Illuminate\Http\Response
     */
    public function show(String $email)
    {
        $newUser = User::where('email', $email) -> first();
        return view('newUser.show', compact('newUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $newUser
     * @return \Illuminate\Http\Response
     */
    public function edit(String $email)
    {
        $newUser = User::where('email', $email) -> first();
        return view('newUser.edit', compact('newUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $newUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $email)
    {
        $val = $request->validate([
            'password' => 'required'
        ]);

        $newUser = User::where('email', $email) -> first();
        $newUser -> password = $val['password'];
        $newUser -> save();

        return redirect()->route('newuser.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $newUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $email)
    {

        $newUser = User::where('email', $email) -> first();
        $newUser->delete();

        return redirect()->route('newuser.index')
            ->with('success', 'User deleted successfully');
    }
}
