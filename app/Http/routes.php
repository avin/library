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

//Регистрация и авторизация
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);



Route::group(['middleware' => ['auth']], function () {

    //Home
    Route::get('/', ['as' => 'home', 'uses' => 'PageController@home']);

    //Профиль
    Route::get('user/profile', ['as' => 'user.profile.index', 'uses' => 'UserController@getProfile']);
    Route::post('user/profile', ['as' => 'user.profile.save', 'uses' => 'UserController@saveProfile']);

    //Книги
    Route::get('book', ['as' => 'book.index', 'uses' => 'BookController@index']);
    Route::get('book/favorite', ['as' => 'book.favorite.index', 'uses' => 'BookController@indexFavorite']);
    Route::get('book/{id}', ['as' => 'book.show', 'uses' => 'BookController@show']);
    Route::post('book/{id}/favorite', ['as' => 'book.favorite.add', 'uses' => 'BookController@addFavorite']);
    Route::delete('book/{id}/favorite', ['as' => 'book.favorite.delete', 'uses' => 'BookController@deleteFavorite']);

    //Админка
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function(){
        //Книги
        Route::resource('book', 'BookController');
        Route::get('book/{id}/delete', ['as' => 'admin.book.delete', 'uses' => 'BookController@delete']);

        //Пользователи
        Route::resource('user', 'UserController', ['except' => ['create', 'store', 'show']]);
        Route::get('user/{id}/delete', ['as' => 'admin.user.delete', 'uses' => 'UserController@delete']);
    });
});

