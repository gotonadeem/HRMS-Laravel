<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['install']], function () {
	Auth::routes();
	Route::get('/', function () {
		return redirect('login');
	});
	Route::group(['middleware' => ['auth']], function () {
		Route::get('/dashboard', 'DashboardController@index');
		Route::get('profile/show', 'ProfileController@show')->name('profile.show');
		Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
		Route::post('profile/update', 'ProfileController@update')->name('profile.update');
		Route::get('password/change', 'ProfileController@password_change')->name('password.change');
		Route::post('password/update', 'ProfileController@update_password')->name('password.update');
		Route::group(['prefix' => 'administration', 'as' => 'administration.'], function(){
			Route::any('settings/general', 'SettingsController@general');
			Route::resource('languages', 'LanguageController');
			Route::get('datatable_backup', 'BackupController@index');
		});
		
		Route::resource('users', 'UserController');
		Route::resource('departments','DepartmentController');
		Route::resource('notices','NoticeController');
		Route::resource('employees','EmployeeController');
		Route::resource('clients','ClientController');
		Route::resource('projects','ProjectController');
		
	});
});

Route::get('/installation', 'Install\InstallController@index');
Route::get('install/database', 'Install\InstallController@database');
Route::post('install/process_install', 'Install\InstallController@process_install');
Route::get('install/create_user', 'Install\InstallController@create_user');
Route::post('install/store_user', 'Install\InstallController@store_user');
Route::get('install/system_settings', 'Install\InstallController@system_settings');
Route::post('install/finish', 'Install\InstallController@final_touch');



