<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Debug API - TAMBAHKAN INI
    Route::get('/debug-api', function () {
        $headers = [
            'X-username' => 'admin',
            'X-password' => 'secret',
        ];
        
        try {
            $response = Http::withHeaders($headers)->get('https://mockapi.pkuwsb.id/api/patient');
            
            return response()->json([
                'status' => $response->status(),
                'successful' => $response->successful(),
                'response_type' => gettype($response->json()),
                'data' => $response->json(),
                'raw_body' => $response->body()
            ], 200, [], JSON_PRETTY_PRINT);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500, [], JSON_PRETTY_PRINT);
        }
    });
    
    // Patients CRUD
    Route::resource('patients', PasienController::class);
});

require __DIR__.'/auth.php';