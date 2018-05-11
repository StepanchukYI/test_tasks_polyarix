<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_role_id')->default(2);
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

	        $table->foreign( 'user_role_id' )->references( 'id' )->on( 'user_roles' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
