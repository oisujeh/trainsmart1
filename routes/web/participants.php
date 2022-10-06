<?php

use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->name('participants.')
    ->group(function(){
        Route::get('participants', [ParticipantController::class,'index'])->name('index');
        Route::get('participants/create', [ParticipantController::class,'create'])->name('create');
        Route::get('participants/show/{id}', [ParticipantController::class,'show'])->name('show');
        Route::post('participants', [ParticipantController::class,'store'])->name('store');
        Route::delete('participants/{participant}', [ParticipantController::class,'destroy'])->name('destroy');
    });
