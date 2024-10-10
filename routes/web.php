<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

Route::get('/', function (Request $request) {
    return Inertia::render('Welcome');
});

Route::post('get-status', function (Request $request) {
    $request->validate([
        'value' => ['required', 'string', 'regex:/^\d{13}$|^\d{17}$/'],
    ]);
    $user = User::whereNid($request->value)->first();
    return Inertia::render('Welcome', [
        'user' => $user
    ]);
    
})->name('get-status');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
