<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
 

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    
    //administratori
  
    Route::resource('admin','AdminController');

   //home
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    

    //cimitire

 	Route::post('cimitire/index_filtrat' , ['as'=>'index_filtrat' , 'uses'=>'CimitireController@index_filtrat']);
 	Route::post('cimitire/show_filtrat' , ['as'=>'show_filtrat' , 'uses'=>'CimitireController@show_filtrat']);
    Route::get('cimitire/print',[ 'as'=>'print_cimitire', 'uses'=>'CimitireController@print_cimitire']);
    Route::get('cimitire/{id?}/parcele' , ['as'=>'getCimitirParcele', 'uses'=>'AppController@getParcele']);
    Route::get('cimitire/export' , ['as'=>'export_cimitire' , 'uses'=>'CimitireController@export_cimitire']);
    Route::resource('cimitire' , 'CimitireController' );
    


    //parcele


    Route::post('parcele/index_filtrat' , ['as'=>'parcele_index_filtrat' , 'uses'=>'ParceleController@index_filtrat']);
    Route::post('parcele/show_filtrat' , ['as'=>'parcele_show_filtrat' , 'uses'=>'ParceleController@show_filtrat']);
    Route::get('parcele/print',[ 'as'=>'print_parcele', 'uses'=>'ParceleController@print_parcele']);
    Route::get('parcele/{id?}/locuri' , ['as'=>'getParcelaLocuri', 'uses'=>'AppController@getLocuri']);
    Route::get('parcele/export' , ['as'=>'export_parcele' , 'uses'=>'ParceleController@export_parcele']);
    Route::resource('parcele', 'ParceleController');
    


    //locuri

    Route::post('locuri/index_filtrat' , ['as'=>'locuri_index_filtrat' , 'uses'=>'LocuriController@index_filtrat']);
    Route::post('locuri/show_filtrat' , ['as'=>'locuri_show_filtrat' , 'uses'=>'LocuriController@show_filtrat']);
    Route::get('locuri/print',[ 'as'=>'print_locuri', 'uses'=>'LocuriController@print_locuri']);
    Route::get('locuri/export' , ['as'=>'export_locuri' , 'uses'=>'LocuriController@export_locuri']);
    Route::resource('locuri', 'LocuriController');

   
    //
    Route::get('dashboard', 'DashboardController@index');

   
});


