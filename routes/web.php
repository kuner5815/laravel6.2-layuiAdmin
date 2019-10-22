<?php
Route::get('login', 'Administrators\SessionsController@create')->name('login');
Route::post('login', 'Administrators\SessionsController@store')->name('login');
Route::delete('logout', 'Administrators\SessionsController@destroy')->name('logout');

Route::middleware(['rbac'])->group(function (){
	//控制台
	Route::get('/home', function () {
	    return view('home');
	})->name('console.index');	
	//mian
	Route::get('/', function () {
	    return view('main');
	})->name('main.index');

	//管理员
	Route::resource('admins', 'Administrators\AdminsController');
	Route::post('admins/multipleDestroy','Administrators\AdminsController@multipleDestroy')->name('admins.multipleDestroy');//多选删除
	
	//角色
	Route::resource('roles', 'Administrators\RolesController');
	Route::post('roles/multipleDestroy','Administrators\RolesController@multipleDestroy')->name('roles.multipleDestroy');//多选删除
	
	//权限
	Route::resource('permissions', 'Administrators\PermissionsController');
	Route::post('permissions/multipleDestroy','Administrators\PermissionsController@multipleDestroy')->name('permissions.multipleDestroy');//多选删除
	
	//角色权限关联
	Route::resource('role_permission_links', 'Administrators\RolePermissionLinksController',['only' => ['store','edit','update']]);
});
//管理员列表
Route::get('admins_list','Administrators\AdminsController@list')->name('admins.list');
//角色列表
Route::get('roles_list','Administrators\RolesController@list')->name('roles.list');
//权限列表
Route::get('permissions_list','Administrators\PermissionsController@list')->name('permissions.list');


