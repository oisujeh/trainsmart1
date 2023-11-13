<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('reports/trainings_by_participants', [ReportController::class,'trainings_by_participants'])->name('trainings_by_participants');
