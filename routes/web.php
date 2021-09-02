<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\SpaController;
/**
 * Catch all routes and map it to our index method
 * which will simple return home view no matter what
 * the route.
 */
Route::get('/{any}',  [SpaController::class, 'index'])->where('any','.*');
// '@index'
