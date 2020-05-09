<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('usuarios', 'UserController')->names('users')->parameters(['usuarios'=>'users']);

Route::resource('obras', 'WorksController')->names('work')->parameters(['obras'=>'work']);

Route::resource('exemplares', 'ExemplaryController')->names('exemplaries')->parameters(['exemplares'=>'exemplaries']);

Route::resource('emprestimos', 'LoanController')->names('loans')->parameters(['emprestimos'=>'loans']);


