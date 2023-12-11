<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasicInfoController;

use App\Http\Controllers\ConsultantInfoController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\ProfileControllerBasicInformation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('home.home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile-basic-info', [BasicInfoController::class, 'update'])->name('profile-basic-info.update');

    Route::patch('/profile-consultant-info', [ConsultantInfoController::class, 'update'])->name('profile-consultant-info.update');

    Route::patch('/profile-expertise-info', [ExpertiseController::class, 'update'])->name('expertise.update');


});

require __DIR__.'/auth.php';
