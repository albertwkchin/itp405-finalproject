<?php

Route::get('/', 'WelcomeController@index');
Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds/results', 'DvdController@results');
Route::get('/dvds/{id}','DvdController@review');