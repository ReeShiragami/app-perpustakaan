<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\StatsController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'REST API berhasil dijalankan',
    ]);
});
Route::get('/stats', [StatsController::class, 'index']);
Route::apiResource('/books', BookController::class);
Route::apiResource('/members', MemberController::class)->only(['index', 'show']);
Route::apiResource('/loans', LoanController::class)
    ->only(['index', 'store', 'show']);
Route::put(
    '/loans/{id}/kembalikan',
    [LoanController::class, 'kembalikan']
);