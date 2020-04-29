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

    Route::resource('companies', 'CompaniesController');

    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('/projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
    Route::get('items', 'itemsController');
    Route::post('items/submit', 'MessagesController@submit');
    Route::get('/messages', 'ProductsController@getMessages');


    Route::resource('projects', 'ProjectsController');
    Route::resource('roles', 'RolesController');
    Route::resource('tasks', 'TasksController');
    Route::resource('users', 'UsersController');
    Route::resource('items', 'itemsController');
    Route::resource('comments', 'CommentsController');
    Route::resource('messages', 'MessagesController');



});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('view-companies', 'AdminViewController@index')->name('companies.admin');
    Route::get('view-users', 'AdminViewController@home')->name('users.admin');
});
