<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('post');


Route::middleware('auth')->group(function(){

    Route::get('/admin', 'AdminsController@index')->name('admin.index');

    Route::get('/admin/posts', 'PostController@index')->name('post.index');
    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');


    Route::delete('/admin/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.update');
    Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');


    Route::get('admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');
    Route::put('admin/users/{user}/update', 'UserController@update')->name('user.profile.update');


    Route::delete('admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');

    Route::put('admin/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::put('admin/users/{user}/detach', 'UserController@detach')->name('user.role.detach');
    Route::get('/admin/roles', 'RoleController@index')->name('roles.index');
    Route::post('/admin/roles', 'RoleController@store')->name('role.store');
    Route::delete('admin/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
    Route::get('/admin/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('admin/roles/{role}/update', 'RoleController@update')->name('role.update');
    Route::put('admin/roles/{role}/update', 'RoleController@update')->name('role.update');
    Route::put('/admin/roles/{role}/attach', 'RoleController@attach_permission')->name('role.permission.attach');
    Route::put('/admin/roles/{role}/detach', 'RoleController@detach_permission')->name('role.permission.detach');
    
    Route::get('/admin/permissions', 'PermissionController@index')->name('permissions.index');
    Route::post('/admin/permissions', 'PermissionController@store')->name('permissions.store');
    Route::delete('admin/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
    Route::get('/admin/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::put('admin/permissions/{permission}/update', 'PermissionController@update')->name('permission.update');

});

    Route::middleware(['role:admin','auth'])->group(function(){

    Route::get('admin/users', 'UserController@index')->name('users.index');
});




