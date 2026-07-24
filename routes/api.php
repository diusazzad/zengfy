<?php

use App\Http\Controllers\Api\V1\ModuleApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::controller(ModuleApiController::class)->prefix('v1')->group(function () {
    Route::get('/modules', 'index')->middleware(['throttle:60,1'])->name('api.v1.modules.index');
    Route::get('/modules/{subdomain}', 'show')->middleware(['throttle:60,1'])->name('api.v1.modules.show');
});
