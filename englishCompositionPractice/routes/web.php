<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;

Route::get('/main',[mainController::class,'index'])->name('index');
Route::post('/main',[mainController::class,'post'])->name('post');



