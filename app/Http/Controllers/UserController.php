<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User;
        return view('user.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email', //ensure unique users and email
            'status' => 'required|in:1,0'
        ], [
            // 'name.required' => 'user name is required', 
            // 'name.min' => 'User name must be at least 5 chars'
        ]);

        $request['password'] = bcrypt('123456'); //option 1: to set default password, since password column is not nullable.
       
        $user = new User;
        $user->fill($request->all());
        
        // $user->password = bcrypt("123456"); // option 2: to set default password, since password column is not nullable.

        $user->save();

        return redirect()->route('user.index')->with('message', 'New user has been created!'); // with('variable_name', 'variable_value') this to pass to UI as prompt message

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id, //allow edit of the same email, since same email is not allowed (unique) set in validation
            'role' => 'required|in:staff,admin',
            'status' => 'required|in:1,0'
            
        ],);

        $user->fill($request->all());
        $user->save();

        return redirect()->route('user.index')->with('message', 'User record has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
