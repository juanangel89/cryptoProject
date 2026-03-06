<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoController;

Route::get('/crypto', [CryptoController::class, 'index']);
