<?php

use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Route;

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


Route::get("/", [usuarioController::class, "listar"])->name("index");
Route::get("/editar/{id}", [usuarioController::class, "edit"])->name("user.editar");
Route::post("/update/{id}", [usuarioController::class, "update"])->name("user.update");
Route::delete("/delete/{id}", [usuarioController::class, "delete"])->name("user.delete");
Route::get("/ver/pdf/{id}", [usuarioController::class, "pdf"])->name("user.pdf");

Route::post("user", [usuarioController::class, "registrar"])->name("user.registrar");