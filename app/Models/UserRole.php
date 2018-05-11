<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	const ADMIN = 1;

	const USER= 2;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title'
	];

	public function users(){
		return $this->hasMany(User::class, 'id','user_id');
	}
}
