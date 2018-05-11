<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = collect([]);
        collect([
        	[
        		'id' => 1,
		        'title' => 'Администратор'
	        ],
	        [
	        	'id' => 2,
		        'title' => 'Пользователь'
	        ]
        ])->each(function ($item) use(&$role){
        	$role = $role->merge(factory(\App\Models\UserRole::class, 1)->create($item));
        });
    }
}
