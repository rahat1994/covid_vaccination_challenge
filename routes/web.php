<?php

use App\Models\User;
use Carbon\Carbon;
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
    // $user = User::whereNid($request->value)->first();
    // DB::enableQueryLog();
    $user = DB::selectOne('select id from users where nid = ? LIMIT 1', [$request->value]);
    $appointment = DB::selectOne('select vaccination_appointments.appointment_at from users JOIN vaccination_appointments on users.id = vaccination_appointments.user_id where users.nid = ? LIMIT 1', [$request->value]);
    // dd(DB::getQueryLog());
    $status = null;

    if(empty($user)) {
        $status = 'Not Registered';
    } else{
        if(empty($appointment)) {
            $status = 'Not Scheduled';
        } else {
            if(Carbon::parse($appointment[0]->appointment_at)->isPast()) {
                $status = 'Vaccinated';
            }
            $status = 'Scheduled';
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
