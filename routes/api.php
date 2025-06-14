<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\userController;

Route::post('/register',[userController::class,'register']);
Route::post('/login',[userController::class,'login']);

Route::post('/kategori',[kategoriController::class,'create']);
Route::get('/kategori',[kategoriController::class,'getAll']);
Route::get('/kategori/{id}',[kategoriController::class,'getId']);
Route::put('/kategori/{id}',[kategoriController::class,'update']);
Route::delete('/kategori/{id}',[kategoriController::class,'delete']);

Route::post('/buku',[bukuController::class,'create']);
Route::get('/buku',[bukuController::class,'getAll']);
Route::get('/buku/{id}',[bukuController::class,'getId']);
Route::put('/buku/{id}',[bukuController::class,'update']);
Route::delete('/buku/{id}',[bukuController::class,'delete']);



