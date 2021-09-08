<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'role_id', 'profile_photo_path', 'created_at')->with('role')->get();
        return Inertia::render('Admin/Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Admin/Users/Create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => ['required', Password::min(6)->letters()->mixedCase()->numbers()],
            'password_confirm' => 'required|same:password',
            'profile_photo_path' => 'mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048',
            'role_id' => 'required',

        ]);

        $user_picture = $request->file('profile_photo_path'); 
        if (!empty($user_picture)) {
            $destinationPath = '/user_picture/';
            $profileImage = date('YmdHis') . "." . $user_picture->getClientOriginalExtension();
            $user_picture->storeAs($destinationPath, $profileImage);
            $input['profile_photo_path'] = "$profileImage";

        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
<<<<<<< HEAD
            'profile_photo_path' => $validated['profile_photo_path'],
=======
            'profile_photo_path' => '/images'.$destinationPath.$profileImage, 
>>>>>>> 7ff15283536f7ca95199a857090674bc4a45c2d1
            'role_id' => $validated['role_id'],
        ]);



        return Redirect::route('users.index')->with('message', 'User has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('Admin/Users/Show', ['userShown' => $user, 'role' => $user->role ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return Inertia::render('Admin/Users/Edit', ['userToUpdate' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

    //     // dd($request);
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            // 'password' => Password::min(6)->letters()->mixedCase()->numbers(),
            // 'password_confirm' => 'same:password',
            // 'profile_photo_path' => 'mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048',
            'role_id' => 'required',
        ]);


        // if($request->input('password')) {
        //     $validated['password'] = Hash::make($request->input('password'));
            
        // };
        
        // $user_picture = $request->file('profile_photo_path'); 
        // if (!empty($user_picture)) {
        //     $destinationPath = '/user_picture/';
        //     $profileImage = date('YmdHis') . "." . $user_picture->getClientOriginalExtension();
        //     $user_picture->storeAs($destinationPath, $profileImage);
        //     $input['profile_photo_path'] = "$profileImage";

        // };

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // 'password' => Hash::make(['password']),
            //'profile_photo_path' => '/images'.$destinationPath.$profileImage, 
            'role_id' => $validated['role_id'],
        ]);

        return Redirect::route('users.index')->with('message', 'User has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();

        return Redirect::route('users.index')->with('message', 'Client Deleted');



    }
}
