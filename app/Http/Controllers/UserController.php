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
use Illuminate\Support\Facades\File;

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
            'profile_photo_path' => '/images'.$destinationPath.$profileImage,
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

        $validated = $request->validate([
            'user.name' => 'required|min:3',
            'user.email' => 'required|email',
            'user.password' => Password::min(6)->letters()->mixedCase()->numbers(),
            'user.password_confirm' => 'same:password',
            'user.role_id' => 'required',
        ]);

        $toUpdate = [
            'name' => $validated['user']['name'],
            'email' => $validated['user']['email'],
            'role_id' => $validated['user']['role_id'],
        ];

        $user_picture = $request->file('user.profile_photo_path');

        if (!empty($user_picture)) {

            // $file_path = base_path().''.$user->profile_photo_path;
            
            // if($user->profile_photo_path){ //If it exits, delete it from folder
                
            //     // $picture = explode("/" , $user->profile_photo_path)[3]; 
            //     // Storage::disk('local/user_picture')->delete($picture);
            //     File::delete($picture);
            // }

            $picture = explode("/" , $user->profile_photo_path)[3]; 
            if(File::exists(public_path($picture[2]."/".$picture[3])))
            {
                
                File::delete(public_path($picture[2]."/".$picture[3])); 
            }

            $destinationPath = '/user_picture/';
            $profileImage = date('YmdHis') . "." . $user_picture->getClientOriginalExtension();
            $user_picture->storeAs($destinationPath, $profileImage);
            $input['profile_photo_path'] = "$profileImage";

            $toUpdate['profile_photo_path'] = '/images'.$destinationPath.$profileImage;

            

        };

        if (isset($validated['user']['password'] )){
            $toUpdate['password'] = $validated['user']['password'];
        }

        $user->update($toUpdate); 

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

        $file_path = base_path().''.$user->profile_photo_path;
            if(File::exists($file_path)){ //If it exits, delete it from folder
                File::delete($file_path);
        }
        $user->delete();

        

        return Redirect::route('users.index')->with('message', 'Client Deleted');



    }

    
}
