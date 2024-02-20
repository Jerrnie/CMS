<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BasicInfoController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ConsultantInfoController;
use App\Http\Controllers\SupportingDocumentController;
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

// Route::get('/', function () {

//     return view('home.home');
// })->name('home');

//home controller
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('home.about');
})->name('about');

//show all ongoing opportunities/project
Route::get('/opportunities/ongoing', [OpportunityController::class, 'ongoing'])->name('opportunities.ongoing');

Route::get('/opportunities/all', [OpportunityController::class, 'index'])->name('opportunities.index');

//get single opportunity
Route::get('/opportunities/{opportunity}', [OpportunityController::class, 'show'])->name('opportunities.show');

//apply for opportunity
Route::post('/opportunities/{opportunity}/apply', [OpportunityController::class, 'apply'])->name('opportunities.apply');

//unapply for opportunity
Route::post('/opportunities/{opportunity}/unapply', [OpportunityController::class, 'unapply'])->name('opportunities.unapply');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile-basic-info', [BasicInfoController::class, 'update'])->name('profile-basic-info.update');

    Route::patch('/profile-consultant-info', [ConsultantInfoController::class, 'update'])->name('profile-consultant-info.update');

    Route::patch('/profile-expertise-info', [ExpertiseController::class, 'update'])->name('expertise.update');

    Route::post('/profile-attachement-info', [SupportingDocumentController::class, 'store'])->name('profile-attachement-info.store');

    Route::get('/download-attachment/{attachment_id}', [SupportingDocumentController::class, 'downloadAttachment'])->name('attachment.download');

    Route::delete('/delete-attachment/{attachment_id}', [SupportingDocumentController::class, 'deleteAttachment'])->name('attachment.delete');

    //current project
    Route::get('/projects/current/{id}', [OpportunityController::class, 'showOngoing'])->name('opportunities.ongoing.show');

    // ooprtunities/ ongoing/ show
    Route::get('/opportunities/ongoing/{opportunity}', [OpportunityController::class, 'showOngoing'])->name('opportunities.ongoing.show');

    //opportunities/ongoing/outputs
    Route::get('/opportunities/ongoing/{opportunity}/outputs', [OpportunityController::class, 'outputs'])->name('opportunities.ongoing.outputs');

    //opportunities/ongoing/outputs
    //profile-attachement-info.store
    Route::post('/opportunities/ongoing/{tranch}/outputs', [OpportunityController::class, 'storeOutputs'])->name('opportunities.ongoing.storeOutputs');

});

require __DIR__.'/auth.php';
