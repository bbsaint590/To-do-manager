<?php

use Illuminate\Support\Facades\Route;
USE \App\Http\Controllers\TodoController;

Route::get('/todos/', [TodoController::class, 'allTodos']);

