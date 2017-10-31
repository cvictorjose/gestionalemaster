<?php
Route::get('/', function () { return redirect('/laboratorio'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
});
//LABORATORY

Route::group(['middleware' => ['auth']], function () {

  Route::resource('laboratorio', 'LaboratoryController');

    //ROUND
    Route::resource('round', 'RoundController');
    Route::post('round_labs',array('as'=>'round_labs','uses'=>'RoundController@roundlab'));
    Route::post('round_lab_test',array('as'=>'round_lab_test','uses'=>'RoundController@roundLabTest'));
    Route::put('update_round_lab',array('as'=>'update_round_lab','uses'=>'RoundController@updateRoundLab'));
    Route::post('round_destroy',array('as'=>'round_destroy','uses'=>'RoundController@destroyRound'));
    Route::post('round_destroy_test',array('as'=>'round_destroy_test','uses'=>'RoundController@destroySingleTest'));

   //REPORT
    Route::post('round_report',array('as'=>'round_report','uses'=>'ReportController@roundReport'));

    //REPORT

});


Route::get('grafico',array('as'=>'grafico','uses'=>'ReportController@grafico'));
//AUTOCOMPLETE
Route::get('typeahead-response',array('as'=>'typeahead.response','uses'=>'LaboratoryController@ajaxData'));