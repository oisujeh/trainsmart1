<?php

use App\Http\Controllers\EnrollController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->name('enroll.')
    ->group(function(){
        Route::get('enroll/fetch', [EnrollController::class,'fetch'])->name('fetch');
    });
