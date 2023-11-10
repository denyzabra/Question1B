<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathController;

Route::get('/missing-digit', [MathController::class, 'missing_digit']);
Route::get('/missing-digit-viewer', [MathController::class, 'showMissingDigitViewer']);
