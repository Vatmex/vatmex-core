<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ATCController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TrainingNoteController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Page Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| About Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'about'], function () {
    Route::get('/staff', [PageController::class, 'about_staff'])->name('about.staff');
    Route::get('/roster', [PageController::class, 'about_roster'])->name('about.roster')->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| Pilot Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'pilots'], function () {
    Route::get('/feedback', [PageController::class, 'pilots_feedback'])->name('pilots.feedback')->middleware('auth');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('pilots.feedback.store');
});

/*
|--------------------------------------------------------------------------
| ATC Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'atc'], function () {
    Route::get('/apply', [ApplicationController::class, 'create'])->name('atcs.apply');
    Route::post('/apply', [ApplicationController::class, 'store'])->name('atcs.apply.store');
    Route::post('/unapply', [ApplicationController::class, 'destroy'])->name('atcs.apply.destroy');
    Route::get('/documents', [PageController::class, 'atc_documents'])->name('atcs.documents');
});

/*
|--------------------------------------------------------------------------
| Events Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'events'], function () {
    Route::get('/', [EventController::class, 'siteIndex'])->name('events.index');
    Route::get('/{slug}', [EventController::class, 'siteShow'])->name('events.show');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth'], function () {
    Route::get('redirect', [AuthController::class, 'redirect'])->name('auth.login');
    Route::get('callback', [AuthController::class, 'callback']);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'ops', 'middleware' => ['can:access dashboard']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Site Routes
    Route::group(['prefix' => 'site'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('dashboard.users.index')->middleware('can:view users');
            Route::get('/{cid}', [UserController::class, 'show'])->name('dashboard.users.show')->middleware('can:view users');
            Route::post('/{cid}/assign', [RoleController::class, 'assign'])->name('dashboard.users.assign')->middleware('can:assign roles');
            Route::get('/{cid}/remove/{role}', [RoleController::class, 'remove'])->name('dashboard.users.remove')->middleware('can:remove roles');
        });

        Route::group(['prefix' => 'teams'], function () {
            Route::get('/', [TeamController::class, 'index'])->name('dashboard.teams.index')->middleware('can:view staff');
            Route::get('new', [TeamController::class, 'create'])->name('dashboard.teams.create')->middleware('can:create staff');
            Route::post('new', [TeamController::class, 'store'])->name('dashboard.teams.store')->middleware('can:create staff');
            Route::get('{id}', [TeamController::class, 'show'])->name('dashboard.teams.show')->middleware('can:view staff');
            Route::get('{id}/edit', [TeamController::class, 'edit'])->name('dashboard.teams.edit')->middleware('can:edit staff');
            Route::post('{id}/edit', [TeamController::class, 'update'])->name('dashboard.teams.update')->middleware('can:edit staff');
            Route::post('{id}/link', [TeamController::class, 'link'])->name('dashboard.teams.link')->middleware('can:assign staff');
            Route::get('{id}/unlink', [TeamController::class, 'unlink'])->name('dashboard.teams.unlink')->middleware('can:assign staff');
            Route::post('{id}/delete', [TeamController::class, 'destroy'])->name('dashboard.teams.delete')->middleware('can:delete staff');
        });

        Route::group(['prefix' => 'staff'], function () {
            Route::get('/', [StaffController::class, 'index'])->name('dashboard.staff.index')->middleware('can:view staff');
            Route::get('/new', [StaffController::class, 'create'])->name('dashboard.staff.create')->middleware('can:create staff');
            Route::post('/new', [StaffController::class, 'store'])->name('dashboard.staff.store')->middleware('can:create staff');
            Route::get('/{id}', [StaffController::class, 'show'])->name('dashboard.staff.show')->middleware('can:view staff');
            Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('dashboard.staff.edit')->middleware('can:edit staff');
            Route::post('/{id}/edit', [StaffController::class, 'update'])->name('dashboard.staff.update')->middleware('can:edit staff');
            Route::post('{id}/link', [StaffController::class, 'link'])->name('dashboard.staff.link')->middleware('can:assign staff');
            Route::get('{id}/unlink', [StaffController::class, 'unlink'])->name('dashboard.staff.unlink')->middleware('can:assign staff');
            Route::post('{id}/delete', [StaffController::class, 'destroy'])->name('dashboard.staff.delete')->middleware('can:delete staff');
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories.index')->middleware('can:view documents');
            Route::get('/new', [CategoryController::class, 'create'])->name('dashboard.categories.create')->middleware('can:create documents');
            Route::post('/new', [CategoryController::class, 'store'])->name('dashboard.categories.store')->middleware('can:create documents');
            Route::get('/{id}', [CategoryController::class, 'show'])->name('dashboard.categories.show')->middleware('can:view documents');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit')->middleware('can:edit documents');
            Route::post('/{id}/edit', [CategoryController::class, 'update'])->name('dashboard.categories.update')->middleware('can:edit documents');
            Route::post('{id}/delete', [CategoryController::class, 'destroy'])->name('dashboard.categories.delete')->middleware('can:delete documents');
        });

        Route::group(['prefix' => 'documents'], function () {
            Route::get('/', [DocumentController::class, 'index'])->name('dashboard.documents.index')->middleware('can:view documents');
            Route::get('/new', [DocumentController::class, 'create'])->name('dashboard.documents.create')->middleware('can:create documents');
            Route::post('/new', [DocumentController::class, 'store'])->name('dashboard.documents.store')->middleware('can:create documents');
            Route::get('/{id}', [DocumentController::class, 'show'])->name('dashboard.documents.show')->middleware('can:view documents');
            Route::get('/{id}/edit', [DocumentController::class, 'edit'])->name('dashboard.documents.edit')->middleware('can:edit documents');
            Route::post('/{id}/edit', [DocumentController::class, 'update'])->name('dashboard.documents.update')->middleware('can:edit documents');
            Route::post('/{id}/delete', [DocumentController::class, 'destroy'])->name('dashboard.documents.delete')->middleware('can:delete documents');
        });
    });

    // Training Routes
    Route::group(['prefix' => 'training'], function () {
        Route::group(['prefix' => 'applications'], function () {
            Route::get('/', [ApplicationController::class, 'index'])->name('dashboard.applications.index')->middleware('can:view applications');
            Route::get('/{id}', [ApplicationController::class, 'show'])->name('dashboard.applications.show')->middleware('can:view applications');
            Route::post('/{id}/assign', [ApplicationController::class, 'assign'])->name('dashboard.applications.assign')->middleware('can:assign applications');
        });

        Route::group(['prefix' => 'instructors'], function () {
            Route::get('/', [InstructorController::class, 'index'])->name('dashboard.instructors.index')->middleware('can:view instructors');
            Route::get('/{id}', [InstructorController::class, 'show'])->name('dashboard.instructors.show')->middleware('can:view instructors');
            Route::get('/{id}/edit', [InstructorController::class, 'edit'])->name('dashboard.instructors.edit')->middleware('can:edit instructors');
            Route::post('/{id}/edit', [InstructorController::class, 'update'])->name('dashboard.instructors.update')->middleware('can:edit instructors');
            Route::post('/{id}/delete', [InstructorController::class, 'destroy'])->name('dashboard.instructors.delete')->middleware('can:delete instructors');
            Route::get('/{cid}/store', [InstructorController::class, 'store'])->name('dashboard.instructors.store')->middleware('can:create instructors');
        });

        Route::group(['prefix' => 'students'], function () {
            Route::get('/', [StudentController::class, 'index'])->name('dashboard.students.index')->middleware('can:view students');
            Route::get('/{cid}', [StudentController::class, 'show'])->name('dashboard.students.show')->middleware('can:view students');
            Route::post('/{cid}/assign', [StudentController::class, 'assign'])->name('dashboard.students.assign')->middleware('can:assign students');
            Route::post('/{cid}/remove', [StudentController::class, 'remove'])->name('dashboard.students.remove')->middleware('can:remove students');

            Route::group(['prefix' => 'notes'], function () {
                Route::get('/{id}', [TrainingNoteController::class, 'show'])->name('dashboard.trainingNotes.show')->middleware('can:view students');
                Route::get('/{id}/edit', [TrainingNoteController::class, 'edit'])->name('dashboard.trainingNotes.edit')->middleware('can:edit students');
                Route::post('/{id}/edit', [TrainingNoteController::class, 'update'])->name('dashboard.trainingNotes.update')->middleware('can:edit students');
                Route::post('/{id}/delete', [TrainingNoteController::class, 'destroy'])->name('dashboard.trainingNotes.delete')->middleware('can:edit students');
                Route::get('/{cid}/create', [TrainingNoteController::class, 'create'])->name('dashboard.trainingNotes.create')->middleware('can:edit students');
                Route::post('/{cid}/store', [TrainingNoteController::class, 'store'])->name('dashboard.trainingNotes.store')->middleware('can:edit students');
            });

            Route::group(['prefix' => 'sessions'], function () {
                Route::get('/{id}', [TrainingSessionController::class, 'show'])->name('dashboard.trainingSessions.show')->middleware('can:view students');
                Route::get('/{id}/edit', [TrainingSessionController::class, 'edit'])->name('dashboard.trainingSessions.edit')->middleware('can:edit students');
                Route::post('/{id}/edit', [TrainingSessionController::class, 'update'])->name('dashboard.trainingSessions.update')->middleware('can:edit students');
                Route::get('/{id}/cancel', [TrainingSessionController::class, 'cancel'])->name('dashboard.trainingSessions.cancel')->middleware('can:edit students');
                Route::post('/{id}/cancel', [TrainingSessionController::class, 'remove'])->name('dashboard.trainingSessions.remove')->middleware('can:edit students');
                Route::get('/{cid}/create', [TrainingSessionController::class, 'create'])->name('dashboard.trainingSessions.create')->middleware('can:edit students');
                Route::post('/{cid}/store', [TrainingSessionController::class, 'store'])->name('dashboard.trainingSessions.store')->middleware('can:edit students');
            });
        });
    });

    // Ops Routes
    Route::group(['prefix' => 'atc'], function () {
        Route::group(['prefix' => 'feedback'], function () {
            Route::get('/', [FeedbackController::class, 'index'])->name('dashboard.feedbacks.index')->middleware('can:view atcs');
            Route::get('/{id}', [FeedbackController::class, 'show'])->name('dashboard.feedbacks.show')->middleware('can:view atcs');
        });

        Route::get('/', [ATCController::class, 'index'])->name('dashboard.atcs.index')->middleware('can:view atcs');
        Route::get('/{cid}', [ATCController::class, 'show'])->name('dashboard.atcs.show')->middleware('can:view atcs');
        Route::get('/{cid}/edit', [ATCController::class, 'edit'])->name('dashboard.atcs.edit')->middleware('can:edit atcs');
        Route::post('/{cid}/edit', [ATCController::class, 'update'])->name('dashboard.atcs.update')->middleware('can:edit atcs');
        Route::post('/{cid}/activate', [ATCController::class, 'activate'])->name('dashboard.atcs.activate')->middleware('can:edit atcs');
        Route::post('/{cid}/deactivate', [ATCController::class, 'deactivate'])->name('dashboard.atcs.deactivate')->middleware('can:edit atcs');
    });

    // Event Routes
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', [EventController::class, 'dashboardIndex'])->name('dashboard.events.index')->middleware('can:view events');
        Route::get('/new', [EventController::class, 'create'])->name('dashboard.events.create')->middleware('can:create events');
        Route::post('/new', [EventController::class, 'store'])->name('dashboard.events.store')->middleware('can:create events');
        Route::get('/{slug}', [EventController::class, 'edit'])->name('dashboard.events.edit')->middleware('can:edit events');
        Route::post('/{slug}', [EventController::class, 'update'])->name('dashboard.events.update')->middleware('can:edit events');
        Route::post('/{id}/delete', [EventController::class, 'destroy'])->name('dashboard.events.delete')->middleware('can:delete events');
    });

    Route::group(['prefix' => 'audit'], function () {
        Route::get('/logs', [AuditController::class, 'activityIndex'])->name('dashboard.audit.logs')->middleware('can:view logs');
        Route::get('/user', [AuditController::class, 'userIndex'])->name('dashboard.audit.users')->middleware('can:view records');
    });
});
