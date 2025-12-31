<?php

use App\Http\Controllers\Api\V1\ClaimController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix("v1")->group(function () {
        Route::apiResource('claims', ClaimController::class);
    });
});

require __DIR__.'/auth.php';
