<?php
use App\Http\Controllers\ImageController;

Route::get('/serve_image', [ImageController::class, 'serveImage'])->name('serve_image');
/* If you want to not access this image after logged out you can give below routes */
// Route::get('/serve_image', [ImageController::class, 'serveImage'])->name('serve_image')->middleware('auth');
