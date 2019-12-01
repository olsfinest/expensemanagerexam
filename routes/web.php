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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




// go to contoller next

Route::resource('expense ' , 'ExpenseController');


Route::post ( '/storeExpense', 'ExpenseController@storeExpense' );

Route::get ( '/getExpense', 'ExpenseController@getExpense' );

Route::post ( '/deleteExpense/{id}', 'ExpenseController@deleteExpense' );

Route::post ( '/editExpense/{id}', 'ExpenseController@editExpense' );


Route::resource('expensecat' , 'ExpenseCatController');

Route::post ( '/storeExpenseCat', 'ExpenseCatController@storeExpenseCat' );

Route::get ( '/getExpenseCat', 'ExpenseCatController@getExpenseCat' );

Route::post ( '/deleteExpenseCat/{id}', 'ExpenseCatController@deleteExpenseCat' );

Route::post ( '/editExpenseCat/{id}', 'ExpenseCatController@editExpenseCat' );


Route::resource('userrole' , 'UserRoleController');


Route::post ( '/storeUserRole', 'UserRoleController@storeUserRole' );

Route::get ( '/getUserRole', 'UserRoleController@getUserRole' );

Route::post ( '/deleteDeleteRole/{id}', 'UserRoleController@deleteDeleteRole' );

Route::post ( '/editUserRole/{id}', 'UserRoleController@editUserRole' );



Route::resource('user' , 'UserController');


Route::post ( '/storeUser', 'UserController@storeUser' );

Route::get ( '/getUser', 'UserController@getUser' );

Route::post ( '/deleteUser/{id}', 'UserController@deleteUser' );

Route::post ( '/editUser/{id}', 'UserController@editUser' );
