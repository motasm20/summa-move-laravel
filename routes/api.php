<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\PerformanceController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ✅ Login route voor token (via Sanctum)
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('flutter-app')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});

// ✅ Authenticated user info ophalen (handig voor Flutter)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Openbare route: iedereen mag oefeningen bekijken
Route::get('/exercises', [ExerciseController::class, 'index']);

// ✅ Beveiligde routes: alleen toegankelijk met geldig Bearer token
Route::middleware('auth:sanctum')->group(function () {

    // 🔒 Alleen admins mogen oefeningen beheren
    Route::middleware('is_admin')->group(function () {
        Route::post('/exercises', [ExerciseController::class, 'store']);
        Route::put('/exercises/{exercise}', [ExerciseController::class, 'update']);
        Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy']);
    });

    // 🔐 Alle ingelogde gebruikers kunnen hun eigen prestaties beheren
    Route::get('/performances', [PerformanceController::class, 'index']);
    Route::post('/performances', [PerformanceController::class, 'store']);
    Route::put('/performances/{performance}', [PerformanceController::class, 'update']);
    Route::delete('/performances/{performance}', [PerformanceController::class, 'destroy']);
});

// ✅ Registratie route (voor Flutter)
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'user', // standaardrol
    ]);

    $token = $user->createToken('flutter-app')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});

