<?php
use SleepingOwl\Admin\Navigation\Page as AdminPage;
use SleepingOwl\Admin\Facades\Admin as AdminSection;

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
	return AdminSection::view($content, 'Dashboard');
}]);

Route::get( '{adminModel}' , function()
{
	$content = 'Define your dashboard here.';

	return AdminSection::view( $content , 'Статистика' );
} );

SleepingOwl\Admin\Facades\Navigation::setFromArray( [
	[
		'title'    => trans( 'Пользователи' ) ,
		'icon'     => 'fa fa-group' ,
		'priority' => 1000 ,
		'pages'    => [
			( new AdminPage( App\Models\User::class ) )->setIcon( 'fa fa-user' )->setPriority( 0 ) ,
			( new AdminPage( App\Models\UserRole::class ) )->setIcon( 'fa fa-user' )->setPriority( 0 ) ,
			( new AdminPage( App\Models\UserComment::class ) )->setIcon( 'fa fa-user' )->setPriority( 0 ) ,
			[
				'title' => 'Создать пользователя' ,
				'icon'  => 'fa fa-plus' ,
				'url'   => url( '/admin/users/create' ) ,
			] ,
			[
				'title' => 'Создать роль' ,
				'icon'  => 'fa fa-plus' ,
				'url'   => url( '/admin/user_roles/create' ) ,
			] ,
		]
	] ,
] );
