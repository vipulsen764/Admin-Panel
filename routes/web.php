<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmplyoeeController;
use App\Http\Controllers\LoginController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin_login', [LoginController::class, 'adminlogin'])->name('loginform');
Route::get('/admin_logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/admin_login', [LoginController::class, 'checklogin'])->name('checklogin');



Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
Route::get('/addcompany', [CompanyController::class, 'addcompany'])->name('addcompanies');
Route::post('/addcompany', [CompanyController::class, 'addcompanydata'])->name('addcompaniesdata');

Route::get('/editcompany/{id}', [CompanyController::class, 'editcompany'])->name('editcompany');
Route::post('/editcompany', [CompanyController::class, 'editcompanydata'])->name('editcompanydata');
Route::get('/deletecompany/{id}', [CompanyController::class, 'deletecompany'])->name('deletecompany');


Route::get('/employees', [EmplyoeeController::class, 'index'])->name('employees');
Route::get('/addemployee', [EmplyoeeController::class, 'addemployee'])->name('addemployee');
Route::post('/addemployee', [EmplyoeeController::class, 'addemployeedata'])->name('addemployeedata');
Route::get('/editemployee/{id}', [EmplyoeeController::class, 'editemployee'])->name('editemployee');
Route::post('/editemployee', [EmplyoeeController::class, 'editemployeedata'])->name('editemployeedata');
Route::get('/deleteemployee/{id}', [EmplyoeeController::class, 'deleteemployee'])->name('deleteemployee');


Route::get('image-crop', [CompanyController::class, 'imagedata']);
Route::post('image-crop/upload', [CompanyController::class, 'upload'])->name('image_crop1');
