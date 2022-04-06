<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PessoaController;

Route::get('/', [PessoaController::class, 'index']);
Route::post('add-update', [PessoaController::class, 'store']);
Route::post('edit', [PessoaController::class, 'edit']);
Route::post('delete', [PessoaController::class, 'destroy']);
