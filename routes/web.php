<?php

use App\Http\Controllers\Invokable\StreamCpptRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'can:ViewPdf:Cppt,cppt'])->group(function () {
    Route::get('/pdf/cppt/{id}', StreamCpptRecordController::class)->name('pdf.cppt');
});
