<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DivisiController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/get_datatables', [HomeController::class, 'get_datatables']);
Route::get('/tambahpegawai', [HomeController::class, 'tambahpegawai']);
Route::post('/store', [HomeController::class, 'store']);
Route::get('/editpegawai/{id}', [HomeController::class, 'edit'])->name('editpegawai');
Route::post('/update', [HomeController::class, 'update'])->name('update');
Route::get('/delete/{id_pegawai}', [HomeController::class,'delete']);
Route::get('/export', [HomeController::class, 'export'])->name('export');
Route::post('/import', [HomeController::class, 'import'])->name('import');
Route::get('/importpegawai', [HomeController::class, 'importpegawai'])->name('importpegawai');


Route::get('/divisi', [DivisiController::class, 'divisi'])->name('divisi');
Route::get('/get_datatables_divisi', [DivisiController::class, 'get_datatables_divisi']);
Route::get('/tambah_divisi', [DivisiController::class, 'tambahdivisi']);
Route::post('/storedivisi', [DivisiController::class, 'storedivisi']);
Route::post('/update_divisi', [DivisiController::class, 'updatedivisi']);
Route::get('/edit_divisi/{id_divisi}', [DivisiController::class, 'editdivisi']);
Route::get('/deletedivisi/{id_divisi}', [DivisiController::class, 'deletedivisi']);


Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/table', [App\Http\Controllers\TableController::class, 'index'])->name('table');
Route::get('/chart', [App\Http\Controllers\ChartController::class, 'index'])->name('chart');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');


