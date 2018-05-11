<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
    	if(!$user = Auth::user()){
    		return abort(403);
	    }
		$userQuery = User::orderBy('updated_at');

//	    where('id', '!=', $user->id)

	    if($user->role->id == UserRole::ADMIN){
		    $userQuery->with('comment', 'role');
	    }

	    $users = $userQuery->get();
	    return view( 'users',['users' => $users]);

    }

	public function user_single(User $user){

		if($user->role == UserRole::ADMIN){
			$user->load('comment', 'role');
		}
		return view( 'editProfile',['users' => $user]);

	}

	public function editProfile(){
    	if(!$user = Auth::user()){
    		return abort(403);
	    }

		return view( 'editProfile',['user' => $user]);
	}

	public function updateProfile(Request $request){
    	if(!$user = Auth::user()){
    		return abort(403);
	    }

		$userData = [
			'name' => $request->get('name'),
			'last_name' => $request->get('last_name'),
			'image' => $request->get('image')
		];

		if($request->get('password')){
			$validation = Validator::make($request->only('password', 'password_confirmation'), [
				'password' => 'required|string|min:6|confirmed',
			]);

			if($validation->errors()->count()){
				return ['errors' => $validation->errors()];
			}
			$userData['password'] = Hash::make($request->get('password'));
		}


		$user->update($userData);

		return view('editProfile',
			[
				'user' => $user,
				'success' => true
			]);
	}
}
