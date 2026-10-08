<?php

use App\Http\Controllers\Bookcontroller;
use App\Http\Controllers\categorycontroller;
use Illuminate\Support\Facades\Route;

Route::redirect('/','/Book'); 

Route::resource('Book', Bookcontroller::class)->parameters(['Book' => 'buku']);
Route::resource('Category', categorycontroller::class)->parameters(['Category' => 'kategori']);
