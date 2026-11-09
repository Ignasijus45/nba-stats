<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/teams');

Route::get('/teams', [TeamController::class, 'index']);
