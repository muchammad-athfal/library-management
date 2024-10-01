<?php

use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api.checkApiKey')->group(function () {
    // Authors Api Route Resources
    Route::apiResource('authors', AuthorController::class);

    // Get Books By Author
    Route::get('authors/{id}/books', [AuthorController::class, 'booksByAuthor']);

    // Books Api Route Resources
    Route::apiResource('books', BookController::class);
});
