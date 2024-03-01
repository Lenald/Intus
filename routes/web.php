<?php
declare(strict_types=1);

use App\Http\Controllers\IndexController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::post('/save', [IndexController::class, 'save']);

Route::get('/{any}', [RedirectController::class, 'match'])
    ->where('any', '^(?!.*\.(css|js)).*$');
