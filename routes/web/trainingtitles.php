<?php

use App\Http\Controllers\TrainingTitleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->name('trainingtitles.')
    ->group(function(){
        Route::get('titles', [TrainingTitleController::class,'index'])->name('index');
        Route::get('titles/create', [TrainingTitleController::class,'create'])->name('create');
        Route::get('titles/{id}/edit', [TrainingTitleController::class,'edit'])->name('edit');
        Route::get('titles/{id}/update', [TrainingTitleController::class,'update'])->name('update');
        Route::post('titles', [TrainingTitleController::class,'store'])->name('store');
        Route::delete('titles/{participant}', [TrainingTitleController::class,'destroy'])->name('destroy');
    });
