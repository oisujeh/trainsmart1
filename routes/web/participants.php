<?php

use App\Http\Controllers\ParticipantsController;

Route::middleware('auth')
    ->name('participants.')
    ->group(function(){
        Route::get('participants', [ParticipantsController::class,'index'])->name('index');
        Route::get('participants/create', [ParticipantsController::class,'create'])->name('create');
        Route::get('participants/show', [ParticipantsController::class,'show'])->name('show');
        Route::post('participants', [ParticipantsController::class,'store'])->name('store');
    });
