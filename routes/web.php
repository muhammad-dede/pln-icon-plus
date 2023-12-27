<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisKonsumsiController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RuangMeetingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaktuMeetingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('/user', UserController::class)->except('show');
    Route::resource('/ruang-meeting', RuangMeetingController::class)->except('show');
    Route::resource('/waktu-meeting', WaktuMeetingController::class)->except('show');
    Route::resource('/jenis-konsumsi', JenisKonsumsiController::class)->except('show');
    Route::controller(MeetingController::class)->group(function () {
        Route::post('meeting/status/{meeting}', 'status')->name('meeting.status');
    });
    Route::resource('/meeting', MeetingController::class);
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout')->name('logout');
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'showLogin')->name('login');
        Route::post('login', 'login')->name('login');
    });
});
