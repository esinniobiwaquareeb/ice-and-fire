<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function (){
    return response()->json([ 
        'status' => 200, "data" => "Cool... You\'ve reached the root url"
    ],200);
});
Route::group(['prefix' => 'external-books'], function () {
    Route::get('/', [BookController::class, 'getExternalBooks'])->name('get-external-books');
    Route::get('/{id}', [BookController::class, 'showSingleExternalBook'])->name('show-single-external-book');
});
Route::group(['prefix' => 'v1'], function () {
    Route::match(array('GET','POST'),'books', [BookController::class, 'books']);
    Route::patch('/books/{id}', [BookController::class, 'update'])->name('update-book');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('get-book');
    Route::delete('/books/{id}', [BookController::class, 'delete'])->name('delete-book');
});