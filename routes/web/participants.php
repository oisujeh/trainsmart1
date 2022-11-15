<?php

use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->name('participants.')
    ->group(function(){
        Route::get('participants', [ParticipantController::class,'index'])->name('index');
        Route::get('participants/create', [ParticipantController::class,'create'])->name('create');
        Route::get('participants/show/{id}', [ParticipantController::class,'show'])->name('show');
        Route::get('participants/{id}/edit', [ParticipantController::class,'edit'])->name('edit');
        Route::post('participants/update', [ParticipantController::class,'store'])->name('store');
        Route::put('participants', [ParticipantController::class,'update'])->name('update');
        Route::delete('participants/{participant}', [ParticipantController::class,'destroy'])->name('destroy');

        Route::get('participants/fetch', [ParticipantController::class,'fetch'])->name('fetch');
    });
