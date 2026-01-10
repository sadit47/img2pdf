<?php

use App\Http\Controllers\ImageToPdfController;

Route::get('/img2pdf', [ImageToPdfController::class, 'form']);
Route::post('/img2pdf', [ImageToPdfController::class, 'convert']);
