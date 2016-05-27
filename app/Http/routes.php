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

Route::resource("user" , 'UserController'); 

Route::group(array('prefix' => 'api/v1/' , 'middleware' =>['setResponse' ]), function()
    {
   		Route::resource("user" , 'UserController'); 
   
	});

