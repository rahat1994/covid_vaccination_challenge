<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

Route::get('/', function (Request $request) {
    return Inertia::render('Welcome');
});

Route::post('get-status', function (Request $request) {
    $request->validate([
        'value' => ['required', 'string', 'regex:/^\d{13}$|^\d{17}$/'],
    ]);

    $data = DB::selectOne(
        '
    SELECT u.id, va.appointment_at
    FROM users u
    LEFT JOIN vaccination_appointments va ON u.id = va.user_id
    WHERE u.nid = ?
    LIMIT 1',
        [$request->value]
    );

    $status = 'Not Registered';

    if (!empty($data)) {
        if (empty($data->appointment_at)) {
            $status = 'Not Scheduled';
        } else {
            $status = Carbon::parse($data->appointment_at)->isPast() ? 'Vaccinated' : 'Scheduled';
        }
    }

    return Inertia::render('Welcome', [
        'status' => $status
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
