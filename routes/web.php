<?php

use App\Livewire\ShowHome;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', ShowHome::class)->name('home');
Route::get('festival/{district?}', [ShowHome::class, 'festival']);
