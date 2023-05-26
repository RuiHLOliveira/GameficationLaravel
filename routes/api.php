<?php

use App\Http\Controllers\AnotacaoController;
use App\Http\Controllers\MissaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecursoController;
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

Route::group([
    'namespace' => 'App\Http\Controllers',
    // 'middleware' => 'custom'
], function (){

    Route::resource('personagens', 'PersonagemController')->parameters([
        'personagens' => 'personagem'
        //isso não é singular errado => singular certo
        //isso É plural para singular certo
    ]);

    Route::get('/recursos', [RecursoController::class, 'index']);
    Route::get('/recursos/{recurso}', [RecursoController::class, 'show']);
    Route::post('/recursos', [RecursoController::class, 'store']);
    Route::put('/recursos/{recurso}', [RecursoController::class, 'update']);
    Route::delete('/recursos/{recurso}', [RecursoController::class, 'delete']);

    Route::get('/{personagem}/anotacoes', [AnotacaoController::class, 'index']);
    Route::get('/{personagem}/anotacoes/{anotacao}', [AnotacaoController::class, 'show']);
    Route::post('/{personagem}/anotacoes', [AnotacaoController::class, 'store']);
    Route::put('/{personagem}/anotacoes/{anotacao}', [AnotacaoController::class, 'update']);
    Route::delete('/{personagem}/anotacoes/{anotacao}', [AnotacaoController::class, 'delete']);

    Route::get('/{personagem}/missoes', [MissaoController::class, 'index']);
    Route::get('/{personagem}/missoes/{missao}', [MissaoController::class, 'show']);
    Route::post('/{personagem}/missoes', [MissaoController::class, 'store']);
    Route::put('/{personagem}/missoes/{missao}', [MissaoController::class, 'update']);
    Route::delete('/{personagem}/missoes/{missao}', [MissaoController::class, 'delete']);
    
});

