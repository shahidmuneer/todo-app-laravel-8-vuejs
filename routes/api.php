<?php
use App\Http\Controllers\Auth;
/**
 * Todo CRUD routes
 */

//update a specified todo.
Route::put('/list/{id}','\App\Http\Controllers\ListController@update');


//get all the todos
Route::get('/lists','\App\Http\Controllers\ListController@index');

//store a todo in the database.
Route::post('/list','\App\Http\Controllers\ListController@store');

//get a specified todo.
Route::get('/lists/{id}','\App\Http\Controllers\ListController@show');


//delete a specified todo.
Route::delete('/lists/{id}','\App\Http\Controllers\ListController@destroy');





//get all the todos
Route::get('/todos','\App\Http\Controllers\TodosController@index');

//store a todo in the database.
Route::post('/todos','\App\Http\Controllers\TodosController@store');

//get a specified todo.
Route::get('/todos/{id}','\App\Http\Controllers\TodosController@show');

//update a specified todo.
Route::put('/todos/{id}','\App\Http\Controllers\TodosController@update');

//delete a specified todo.
Route::delete('/todos/{id}','\App\Http\Controllers\TodosController@destroy');






//login users
Route::post('/login','\App\Http\Controllers\Auth\LoginController@authenticate');

//register users
Route::post('/register','\App\Http\Controllers\Auth\RegisterController@register');

//logout users
Route::post('/logout','\App\Http\Controllers\Auth\LoginController@logout')->middleware('jwt.verify');

//get authenticated user
Route::get('/user','\App\Http\Controllers\Auth\LoginController@getAuthenticatedUser')->middleware('jwt.verify');

Route::post('/password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('/password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.reset');
