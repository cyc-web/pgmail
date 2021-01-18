<?php

Route::livewire('/', 'login')->name('login');
Route::livewire('/register', 'register');
Route::group(['middleware' => 'auth'], function(){
    Route::livewire('/inbox', 'inbox')->name('inbox');
    Route::livewire('/create', 'create');
    Route::livewire('/read/{id}', 'read');
    Route::livewire('/view/{id}', 'view');
    Route::livewire('/archives', 'archives');
    Route::livewire('/sent', 'sent');
    Route::livewire('/incoming', 'incoming')->name('incoming');
    Route::livewire('/show/{id}', 'show');
    Route::livewire('/edit/{id}', 'edit');
});

