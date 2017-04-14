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
//Route::get('/', 'UserController@showRegisform');
//Route::get('/', 'UserController@index');
Route::post('/regisuser','UserController@store');
Route::get('/newuser', function () {
    return view('regisuser');
});
//Route::post('/userlogin','UserController@login');

Route::get('/welcome',function () {
    return view('welcome');
} );
Route::get('/logout', 'Auth\AuthController@getLogout');



Route::post('/userlogin', 'Auth\AuthController@postLogin');
//Route::get('/userlogin', 'Auth\AuthController@postLogin');
Route::post('/ajaxreq', 'UserController@login');




    Route::get('/','EmployeeController@index');
    Route::delete('/employee/{id}','EmployeeController@destroy');
    Route::get('/employee/{id}','EmployeeController@edit' );
    Route::get('/employee',function () {return view('/employee/create');} );
    Route::put('/employee/{id}','EmployeeController@update');
    Route::post('/employee', 'EmployeeController@store');


//ajax Request

Route::post('/ajaxemployee','EmployeeController@ajaxcreate');

//for edit
Route::post('/ajaxemployee/{id}','EmployeeController@ajaxupdate');

Route::post('/delete','EmployeeController@delete');

//Route::get('/employee',function () {return view('/employee/index');} );

//Route::delete('/delete/{id}', function ($id) {\App\Employee::findorfail($id)->delete();return redirect('/employee');});


//Route::resource('employees','EmployeeController');







