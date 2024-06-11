<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TodosAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/todos', [TodosAPIController::class, 'toDos']);
Route::get('/todos/{id}', [TodosAPIController::class, 'singleToDos']);
Route::post('/todos',[TodosAPIController::class, 'create']);
Route::delete('/todos',[TodosAPIController::class, 'delete']);
Route::put('/todos/{id}',[TodosAPIController::class, 'update']);
//Route::get('/completed/{completed',[TodosAPIController::class, 'completedTasks']);
//Route::get('/category/',[TodosAPIController::class, 'filterByCategory']);
