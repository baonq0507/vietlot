<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    //notification
    Route::get('/notification', [HomeController::class, 'notification'])->name('notification');
    //recharge
    Route::get('/recharge', [HomeController::class, 'recharge'])->name('recharge');
    Route::post('/recharge', [HomeController::class, 'rechargePost'])->name('rechargePost');
    //profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    //historyplay
    Route::get('/historyplay', [HomeController::class, 'historyplay'])->name('historyplay');
    //historyplayadd
    Route::get('/historyadd', [HomeController::class, 'historyadd'])->name('historyadd');
    //historyplayadd
    Route::get('/historyget', [HomeController::class, 'historyget'])->name('historyget');
    //historyplayadd
    Route::get('/addbank', [HomeController::class, 'addbank'])->name('addbank');
    Route::post('/addbank', [HomeController::class, 'addbankPost'])->name('addbankPost');
    //historyplayadd
    Route::get('/password', [HomeController::class, 'password'])->name('password');
    Route::post('/password', [HomeController::class, 'passwordPost'])->name('passwordPost');
    //kenno5p
    Route::get('/kenno5p', [HomeController::class, 'kenno5p'])->name('kenno5p');
    //kenno3p
    Route::get('/kenno3p', [HomeController::class, 'kenno3p'])->name('kenno3p');
    //kenno1p
    Route::get('/kenno1p', [HomeController::class, 'kenno1p'])->name('kenno1p');
    //placebet
    Route::post('/placebet', [HomeController::class, 'placebet'])->name('placebet');
    //xucxac3
    Route::get('/xucxac3', [HomeController::class, 'xucxac3'])->name('xucxac3');
    //xucxac5
    Route::get('/xucxac5', [HomeController::class, 'xucxac5'])->name('xucxac5');

    //withdraw
    Route::get('/withdraw', [HomeController::class, 'withdraw'])->name('withdraw');
    Route::post('/withdraw', [HomeController::class, 'withdrawPost'])->name('withdrawPost');
    //xoso3p
    Route::get('/xoso3p', [HomeController::class, 'xoso3p'])->name('xoso3p');
});
