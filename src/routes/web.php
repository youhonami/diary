<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'store'])->name('register.store');
Route::get('/toppage', [LoginController::class, 'toppage'])->name('toppage');
Route::get('/diary/create', [LoginController::class, 'diaryCreate'])->name('diary.create');
Route::post('/diary/create', [LoginController::class, 'diaryStore'])->name('diary.store');
Route::get('/diary/lookback', [LoginController::class, 'diaryLookback'])->name('diary.lookback');
Route::get('/diary/lookback/{date}', [LoginController::class, 'diaryShow'])->name('diary.show');
Route::get('/diary/read', [LoginController::class, 'diaryRead'])->name('diary.read');
Route::get('/diary/read/{diary}', [LoginController::class, 'diaryPublicShow'])->name('diary.public.show');
Route::get('/settings', [LoginController::class, 'settings'])->name('settings');
Route::get('/settings/user', [LoginController::class, 'userEdit'])->name('user.edit');
Route::post('/settings/user', [LoginController::class, 'userUpdate'])->name('user.update');
Route::get('/settings/profile', [LoginController::class, 'profileEdit'])->name('profile.edit');
Route::post('/settings/profile', [LoginController::class, 'profileUpdate'])->name('profile.update');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');