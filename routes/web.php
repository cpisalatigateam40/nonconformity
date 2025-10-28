<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FindingController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\UserController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    //resources
    Route::resource('/dashboard', DashboardController::class)->except(['show']);

    Route::get('/finding/create', [FindingController::class, 'index'])->name('finding.create');

    Route::post('/', [FindingController::class, 'store'])->name('finding.store');

    Route::get('/repair/create', [RepairController::class, 'index'])->name('repair.create');

    Route::get('/recap', [RecapController::class, 'index'])->name('recap.index');

    Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis.index');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/nonconformity/{uuid}/data', [FindingController::class, 'fetchData'])->name('nonconformity.fetch-data');

    Route::post('/repair/update', [RepairController::class, 'updateRepair'])->name('perbaikan.storeUpdate');

    Route::get('/department-stats', [RecapController::class, 'departmentStats']);

    Route::get('/recap/filter', [RecapController::class, 'filter'])->name('recap.filter');

    Route::delete('/recap/{uuid}', [RecapController::class, 'destroy'])->name('recap.destroy');


});