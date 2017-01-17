<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('user/login.html', 'UserController@pageLogin');


Route::get('user/listTask', 'TowerController@listTasks');
Route::get('user/addTask', 'TowerController@addTask');
Route::get('user/deleteTask', 'TowerController@deleteTask');

Route::get('user/excel', 'TowerController@excel');

Route::get('user/login.html', 'PageController@pageLogin');
Route::get('user/index.html', 'PageController@pageIndex');
Route::get('user/admin_mgmr.html', 'PageController@pageAdminMgmr');
Route::get('user/task_mgmr.html', 'PageController@pageTaskMgmr');
Route::get('user/user_mgmr.html', 'PageController@pageUserMgmr');
Route::get('user/add_admin.html', 'PageController@pageAddAdmin');
Route::get('user/add_user.html', 'PageController@pageAddUser');

Route::get('user/loginAdmin', 'AdminController@login');
Route::get('user/deleteAdmin', 'AdminController@deleteAdmin');
Route::get('user/addAdmin', 'AdminController@regist');

Route::get('user/login', 'UserController@login');
Route::get('user/regist', 'UserController@regist');
Route::get('user/deleteUser', 'UserController@delete');


Route::get('user/listTask.html', 'TowerController@pageList');
Route::get('user/task_info.html', 'PageController@taskInfo');
