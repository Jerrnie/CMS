<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AdminAuthenticationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('throttle:6,1')
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

    Route::get('admin/login', [AdminAuthenticationController::class, 'create'])
                ->name('admin.login');

    Route::post('admin/login', [AdminAuthenticationController::class, 'store'])
                ->name('admin.login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::post('admin/logout', [AdminAuthenticationController::class, 'destroy'])
    ->name('admin-logout');

    Route::get('admin/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');

    Route::post('admin/settings', [SettingController::class, 'updateSettings'])->name('admin.settings.update');


    //create project
    Route::get('admin/projects/create', [ProjectController::class, 'createProject'])->name('admin.projects.create');
    //submit project
    Route::post('admin/projects/create', [ProjectController::class, 'submitProject'])->name('admin.projects.submit');
    //update project
    Route::put('admin/projects/update/{project}', [ProjectController::class, 'updateProject'])->name('admin.projects.update');
    //detail setup
    Route::get('admin/projects/setup/{project}', [ProjectController::class, 'setupProject'])->name('admin.projects.setup');

    Route::put('/admin/projects/{project}/post', [ProjectController::class, 'post'])->name('admin.projects.post');
    Route::put('/admin/projects/{project}/unpost', [ProjectController::class, 'unpost'])->name('admin.projects.unpost');
    Route::delete('/admin/projects/{project}', [ProjectController::class, 'delete'])->name('admin.projects.delete');
    Route::put('/admin/projects/{project}/remove-consultant', [ProjectController::class, 'removeConsultant'])->name('admin.projects.remove.consultant');

    //reference setup
    Route::get('admin/projects/setup/{project}/reference', [ProjectController::class, 'setupReference'])->name('admin.projects.setup.reference');
    //submit reference
    Route::post('admin/projects/setup/{project}/reference', [ProjectController::class, 'submitReference'])->name('admin.projects.submit.reference');
    //submit edit reference
    Route::put('admin/projects/setup/tranch/edit{tranch}', [ProjectController::class, 'editReference'])->name('admin.projects.edit.reference');
    //delete reference
    Route::delete('admin/projects/setup/{project}/reference', [ProjectController::class, 'deleteReference'])->name('admin.projects.delete.reference');


    //activity setup
    Route::get('admin/projects/setup/{tranch}/activity', [ProjectController::class, 'setupActivity'])->name('admin.projects.setup.activity');
    //submit activity
    Route::post('admin/projects/setup/{tranch}/activity', [ProjectController::class, 'submitActivity'])->name('admin.projects.submit.activity');
    //submit to edit activity
    Route::put('admin/projects/setup/{activity}/edit', [ProjectController::class, 'editActivity'])->name('admin.projects.edit.activity');
    //edit activity
    Route::get('admin/projects/setup/{activity}/edit', [ProjectController::class, 'editActivityView'])->name('admin.projects.edit.activity');
    //delete activity
    Route::delete('admin/projects/setup/{activity}/activity', [ProjectController::class, 'deleteActivity'])->name('admin.projects.delete.activity');



    //deliverable setup
    //add deliverable admin.projects.add.deliverable
    Route::post('admin/projects/setup/{activity}/deliverable', [ProjectController::class, 'addDeliverable'])->name('admin.projects.add.deliverable');
    //delete deliverable
    Route::delete('admin/projects/setup/{deliverable}/deliverable', [ProjectController::class, 'deleteDeliverable'])->name('admin.projects.delete.deliverable');
    //edit deliverable
    Route::put('admin/projects/setup/{deliverable}/deliverable', [ProjectController::class, 'editDeliverable'])->name('admin.projects.edit.deliverable');

    //summary setup
    Route::get('admin/projects/setup/{project}/summary', [ProjectController::class, 'setupSummary'])->name('admin.projects.setup.summary');

    //allprojects
    Route::get('admin/projects', [ProjectController::class, 'allProjects'])->name('admin.projects.all');
    //open projects
    Route::get('admin/projects/open', [ProjectController::class, 'openProjects'])->name('admin.projects.open');
    //view project
    Route::get('admin/projects/{project}/details', [ProjectController::class, 'viewProject'])->name('admin.projects.view');
    //applications
    Route::get('admin/projects/{project}/applications', [ProjectController::class, 'applications'])->name('admin.projects.applications');








    Route::get('admin/forms', function () {
        return view('admin.forms');
    })->name('admin.forms');

    Route::get('admin/tables', function () {
        return view('admin.tables');
    })->name('admin.tables');

    Route::get('admin/ui', function () {
        return view('admin.ui-elements');
    })->name('admin.ui');
});
