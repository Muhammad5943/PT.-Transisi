<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\{ Auth,Route };

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [EmployeeController::class, 'index'])->name('home');
// Route::get('/users', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/employee/import_excel', [EmployeeController::class, 'import_excel']);
Route::get('/employee/export_pdf', [EmployeeController::class, 'pdf_downloader']);

// Employee
Route::get('/employees', [EmployeeController::class, 'index'])->name('posts.all');
Route::get('/add/employee', [EmployeeController::class, 'tambah_employee'])->name('posts.add');
Route::get('/edit/{id}/employee', [EmployeeController::class, 'show'])->name('employee.show');
Route::post('/users', [UserController::class, 'store']);
Route::post('/roles', [UserController::class, 'create_role']);
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::post('/employee/import_excel', [EmployeeController::class, 'import_excel']);

// Company
Route::get('/companies', [CompanyController::class, 'index'])->name('company.all');
Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
Route::get('/add/company', [CompanyController::class, 'tambah_company'])->name('company.create');
Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company.show');
Route::put('/company/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
