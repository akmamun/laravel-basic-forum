<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/threads', 'ThreadsController');
Route::post('/threads/{thread}/replies' , 'RepliesController@store');
Route::get('/threads/{thread}/replies' , 'RepliesController@destroy')->name('reply.destroy');
