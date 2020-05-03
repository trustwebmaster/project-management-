<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('companies', 'CompanyController');

    Route::get('projects/create/{company_id?}', 'ProjectController@create');
    Route::post('/projects/adduser', 'ProjectController@adduser')->name('projects.adduser');
    Route::post('items/submit', 'MessageController@submit');
    Route::get('/messages', 'ProductController@getMessages');


    Route::resource('projects', 'ProjectController');
    Route::resource('tasks', 'TaskController');
    Route::resource('users', 'UserController');
    Route::resource('items', 'ItemController');
    Route::resource('comments', 'CommentController');
    Route::resource('messages', 'MessageController');
});

Route::get('/project/{project}/items', 'ItemController@index');
Route::post('/project/{project}/update-stock', 'ItemController@update_stock');
Route::get('/project/{project}/print', 'ProjectController@printPdf');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('view-companies', 'AdminViewController@index')->name('companies.admin');
    Route::get('view-users', 'AdminViewController@home')->name('users.admin');
});
