<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id','comment'
	];//

	public function user(){
		return $this->hasOne(User::class, 'id', 'user_id');
	}
}
