<?php

use App\Helpers\RouteHelper;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DirectorateController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UsermanagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
});

Route::get('/down', function() {
    Artisan::call('down --secret="1630542a-246b-4b66-afa1-dd72a4c43515"');
});

Route::get('/start', function() {
    Artisan::call('vendor:publish --tag=laravel-errors');
});


Route::get('/', function () {
    return view('/welcome');
});

Route::group(['middleware' => ['auth']], function(){
    Route::resource('directorates', DirectorateController::class);
    Route::resource('enroll',EnrollController::class);
    Route::resource('trainings',TrainingController::class);
    Route::get('trainings', [TrainingController::class,'index'])->name('index');
    Route::get('trainings/submain/{id}','App\Http\Controllers\TrainingController@submain1');
    Route::get('trainings/{id}/edit', 'TrainingController@edit')->name('trainings.edit');

    Route::post('/getEmployees',[EnrollController::class,'getEmployees'])->name('getEmployees');
    Route::resource('users', UsermanagementController::class);

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::get('/dashboard',[DataController::class,'index'])->name('dashboard');

    Route::get('submain/{id}','App\Http\Controllers\TrainingController@submain');
});

Route::prefix('')->group(function(){
    RouteHelper::includeRouteFiles(__DIR__.'/web');
});



