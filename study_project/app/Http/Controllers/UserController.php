<?php

namespace App\Http\Controllers;

use App\Models\NewUser;
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
        $newUsers = NewUser::latest() -> simplePaginate(5);

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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        NewUser::create($request->all());

        return redirect()->route('newuser.index')
            ->with('success', 'New User created successfully!');
        //
    }

    /**
     * Display the specified resource.
     * email을 키값으로 newUser를 검색하여 뷰 페이지에 반환
     * @param  \App\Models\NewUser  String $email
     * @return \Illuminate\Http\Response
     */
    public function show(String $email)
    {
        $newUser = NewUser::where('email', $email) -> first();
        return view('newUser.show', compact('newUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewUser  $newUser
     * @return \Illuminate\Http\Response
     */
    public function edit(String $email)
    {
        $newUser = NewUser::where('email', $email) -> first();
        return view('newUser.edit', compact('newUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewUser  $newUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $email)
    {
        $val = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $newUser = NewUser::where('email', $email) -> first();
        $newUser -> name = $val['name'];
        $newUser -> password = $val['password'];
        $newUser -> save();

        return redirect()->route('newuser.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewUser  $newUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $email)
    {

        $newUser = NewUser::where('email', $email) -> first();
        $newUser->delete();

        return redirect()->route('newuser.index')
            ->with('success', 'User deleted successfully');
    }
}
