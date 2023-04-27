<?php

use App\Http\Controllers\CobrancaController;
use App\Http\Controllers\IdeiaController;
use App\Http\Controllers\MissaoController;
use App\Models\ValorBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\ValorBaseController;
use App\Http\Controllers\PersonagemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group([
//     'prefix' => 'v1',
//     'namespace' => 'App\Http\Controllers\Api',
//     'middleware' => 'auth:sanctum'
// ], function (){
//     Route::apiResource('customers', 'CustomerController');
//     Route::apiResource('invoices', 'InvoiceController');
//     Route::post('invoices/bulk', 'InvoiceController@bulkStore');
// });

// Route::apiResource('personagens', PersonagemController::class)->parameter('personagen', 'personagem');

Route::get('/personagens', [PersonagemController::class, 'index']);
Route::get('/personagens/{personagem}', [PersonagemController::class, 'show']);
Route::post('/personagens', [PersonagemController::class, 'store']);
Route::put('/personagens/{personagem}', [PersonagemController::class, 'update']);
Route::delete('/personagens/{personagem}', [PersonagemController::class, 'destroy']);

Route::get('/valores-base', [ValorBaseController::class, 'index']);

Route::get('/recursos', [RecursoController::class, 'index']);
Route::get('/recursos/{recurso}', [RecursoController::class, 'show']);
Route::post('/recursos', [RecursoController::class, 'store']);

Route::get('/{personagem}/ideias', [IdeiaController::class, 'index']);
Route::get('/{personagem}/ideias/{ideia}', [IdeiaController::class, 'show']);
Route::post('/{personagem}/ideias', [IdeiaController::class, 'store']);
Route::put('/{personagem}/ideias/{ideia}', [IdeiaController::class, 'update']);

Route::get('/{personagem}/cobrancas', [CobrancaController::class, 'index']);
Route::get('/{personagem}/cobrancas/{cobranca}', [CobrancaController::class, 'show']);
Route::post('/{personagem}/cobrancas', [CobrancaController::class, 'store']);
Route::put('/{personagem}/cobrancas/{cobranca}', [CobrancaController::class, 'update']);

Route::get('/{personagem}/missoes', [MissaoController::class, 'index']);
Route::get('/{personagem}/missoes/{missao}', [MissaoController::class, 'show']);
Route::post('/{personagem}/missoes', [MissaoController::class, 'store']);
Route::put('/{personagem}/missoes/{missao}', [MissaoController::class, 'update']);
