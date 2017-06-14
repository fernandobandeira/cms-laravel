<?php

Route::model('categoriaproduto', 'App\Modules\Generico\CategoriaProduto\Model');

Route::as('categoriaproduto.')->prefix('categoriasprodutos')->group(
    function () {
        Route::name('index')->get('/', 'Controller@index');
        Route::name('create')->get('/novo', 'Controller@create');
        Route::name('show')->get('/{categoriaproduto}', 'Controller@show');
        Route::name('edit')->get('/{categoriaproduto}/editar', 'Controller@edit');
        Route::name('store')->post('/', 'Controller@store');
        Route::name('update')->match(['put', 'patch'], '/{categoriaproduto}', 'Controller@update');
        Route::name('destroy')->delete('/{categoriaproduto}', 'Controller@destroy');
    }
);
