<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');
Route::get('/toppage', [LoginController::class, 'toppage'])->name('toppage');
Route::get('/diary/create', [LoginController::class, 'diaryCreate'])->name('diary.create');
Route::get('/diary/lookback', [LoginController::class, 'diaryLookback'])->name('diary.lookback');
Route::get('/diary/read', [LoginController::class, 'diaryRead'])->name('diary.read');
Route::get('/settings', [LoginController::class, 'settings'])->name('settings');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');