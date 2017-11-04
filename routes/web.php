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
Route::get('/', function () {
    return view('welcome');
})->name('idx');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('/loadTasks/', ['as' => 'loadTasks', 'uses' =>'HomeController@loadTasks']);
Route::get('/sortTodos', 'HomeController@sortTodos');
Route::get('/updateSortTodo', 'HomeController@updateSortTodo');
Route::get('/createnew', function () {
    return view('createnew');
});
Route::post('/newTodo', 'HomeController@newTodo');
Route::get('/deleteTodo', 'HomeController@deleteTodo');
Route::get('/cancelTodo', 'HomeController@cancelTodo');
Route::get('/cancelTask', 'HomeController@cancelTask');
Route::get('/doneTask', 'HomeController@doneTask');
Route::get('/deletetask', 'HomeController@deletetask');
Route::get('/newTask', 'HomeController@newTask');