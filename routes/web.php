<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/login', 'pages::auth.login')
    ->middleware('guest')
    ->name('login');

Route::redirect('/', '/inicio');

Route::livewire('/inicio', 'pages::inicio.index')
    ->middleware('auth')
    ->name('inicio.index');

Route::livewire('/controles', 'pages::control.index')
    ->middleware('auth')
    ->name('control.index');
