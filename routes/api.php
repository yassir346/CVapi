<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\QueryBuilderController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::prefix('cvs')->group(function () {
    Route::get('/', [CvController::class, 'index'])->name('cv.index');
    Route::post('/', [CvController::class, 'store'])->name('cv.store');
    Route::get('/{cv}', [CvController::class, 'show'])->name('cv.show');
    Route::put('/{cv}', [CvController::class, 'update'])->name('cv.update');
    Route::delete('/{cv}', [CvController::class, 'destroy'])->name('cv.destroy');
});

Route::prefix('offers')->group(function () {
    Route::get('/', [OffreController::class, 'index'])->name('offer.index');
    Route::get('/{offer}', [OffreController::class, 'show'])->name('offer.show');

    Route::middleware(['auth:sanctum', 'can:is-recruiter'])->group(function () {
        Route::post('/', [OffreController::class, 'store'])->name('offer.store');
        Route::put('/{offer}', [OffreController::class, 'update'])->name('offer.update');
        Route::delete('/{offer}', [OffreController::class, 'destroy'])->name('offer.destroy');
    });

    Route::middleware(['auth:sanctum', 'can:is-candidate'])->group(function () {
        Route::post('/{offer}/apply', [OffreController::class, 'apply'])->name('offer.apply');
    });
});

Route::get('/competences', [CompetenceController::class, 'show'])->name('competence.index');
Route::get('/cvsbuilder', [QueryBuilderController::class, 'show'])->name('cvsbuilder.index');