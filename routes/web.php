<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Semua user yang login boleh melihat daftar post
    Route::resource('posts', PostController::class)->only('index');

    // Hanya admin & editor boleh masuk ke create/edit/hapus
    // (edit/hapus sungguhan masih dibatasi lagi oleh PostPolicy per-post)
    Route::resource('posts', PostController::class)
        ->except(['index', 'show'])
        ->middleware('role:admin,editor');
});

// Khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Bonus: demo eager loading vs N+1
    Route::get('/demo-eager', function () {
        DB::enableQueryLog();
        Product::all()->each(fn ($p) => $p->category->name);
        $lazy = count(DB::getQueryLog());

        DB::flushQueryLog();
        Product::with('category')->get()->each(fn ($p) => $p->category->name);
        $eager = count(DB::getQueryLog());

        return "Tanpa eager loading: {$lazy} query | Dengan with('category'): {$eager} query";
    })->name('demo.eager');
});

require __DIR__ . '/auth.php';
