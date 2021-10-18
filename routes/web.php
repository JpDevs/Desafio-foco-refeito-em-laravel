<?php
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

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
//-
Route::get('/', [ClientesController::class,'index']);
Route::get('/editar/{id}',[ClientesController::class,'edit']);
Route::get('/editar/xml/{id}',[ClientesController::class,'editxml']);
Route::get('/adicionar',[ClientesController::class,'create']);
Route::get('/voucher/{id}',[ClientesController::class,'getVoucher']);
//-
Route::post('/adicionar',[ClientesController::class,'store']);
Route::post('/remover/{id}',[ClientesController::class,'destroy']);
Route::post('editar/{id}',[ClientesController::class,'update']);
Route::post('editar/xml/{id}',[ClientesController::class,'updatexml']);
