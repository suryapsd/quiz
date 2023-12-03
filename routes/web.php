<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Ckeditorcontroller;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\PendidikanInstansiController;
use App\Http\Controllers\Admin\SekolahController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\JenisSoalController;
use App\Http\Controllers\Admin\SoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear-cache', function() {
    $exitCode1 = Artisan::call('cache:clear');
    $exitCode2 = Artisan::call('config:clear');
    $exitCode3 = Artisan::call('view:clear');
    $exitCode4 = Artisan::call('route:clear');
    // $exitCode2 = Artisan::call('vendor:publish');
    // return what you want
    return "Clear Success";
});

Route::get('/', function () {
    return view('welcome');
})->name("landing");

Route::get("/dashboard/redirect", [PageController::class, "dashboard"])->middleware(["auth"])->name("dashboard");
Route::get("/profile/redirect", [PageController::class, "profile"])->middleware(["auth"])->name("profile");

Route::name("auth.")->group(function () {
    Route::middleware(["guest"])->group(function() {
        Route::get("/login", [AuthController::class, "login"])->name("login");
        Route::get("/register", [AuthController::class, "register"])->name("register");
        Route::post("/authenticate", [AuthController::class, "authenticate"])->name("authenticate");
        Route::post("/register/process", [AuthController::class, "registerProcess"])->name("register.process");
    });
    Route::post("/logout", [AuthController::class, "logout"])->middleware(["auth"])->name("logout");
});


Route::post("ckeditor/upload", [CkeditorController::class, 'upload'])->name("ckeditor.upload");
Route::prefix("/admin")->middleware(["auth", "admin"])->name("admin.")->group(function () {
    Route::resource("instansi", InstansiController::class);
    Route::post("getInstansi", [InstansiController::class, 'getData']);
    Route::resource("instansi/{id_instansi}/pendidikan-instansi", PendidikanInstansiController::class);
    Route::post("getPendidikan/{id_instansi}", [PendidikanInstansiController::class, 'getData']);
    Route::resource("sekolah", SekolahController::class);
    Route::post("getSekolah", [SekolahController::class, 'getData']);
    Route::resource("siswa", SiswaController::class);
    Route::post("getSiswa", [SiswaController::class, 'getData']);
    Route::resource("jenis-soal", JenisSoalController::class);
    Route::post("getJenisSoal", [JenisSoalController::class, 'getData']);
    Route::resource("jenis-soal/{id_jenis_soal}/soal", SoalController::class);
    Route::get("/dashboard", [AdminDashboardController::class, "dashboard"])->name("dashboard");
    Route::get("/profile", [AdminDashboardController::class, "profile"])->name("profile");
    Route::patch('/{user}/profile/save', [AdminDashboardController::class, 'profileSave'])->name("profile.save");
});

Route::middleware(["auth", "user"])->name("user.")->group(function () {
    
});


