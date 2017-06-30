<?php

Route::name('dashboard')->get('/', 'DashboardController@index');
Route::name('modulos')->get('/modulos', 'DashboardController@modulos');
Route::name('projetos')->get('/projetos', 'DashboardController@projetos');
Route::name('login')->get('/login', 'DashboardController@login');
Route::name('images')->get('/imgs', 'ImageController@index');