<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'name', 'last_name', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * @return mixed
	 */
    public function role(){
    	return $this->hasOne(UserRole::class, 'id', 'user_role_id');
    }

	/**
	 * @return mixed
	 */
	public function comment(){
		return $this->hasOne(UserComment::class, 'user_id', 'id')->latest();
	}

}
