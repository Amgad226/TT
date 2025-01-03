<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => true, 'reset' => false, 'verify' => false, 'confirm' => false]);



Route::view('/','messenger')->name('tt')->middleware('auth:sanctum');
Route::view('/visitor','test')->name('visitor');
// Route::view('/a','welcome')->name('tt')->middleware('auth:sanctum');


Route::view('/404','404')->name('404');
