<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use App\Models\Cobranca;
use App\Models\Personagem;
use DateTime;

class CobrancaTest extends TestCase
{

    protected $url = '/api/%s/cobrancas/%s';

    private function beforeTest()
    {
        // $this->removerPersonagens();
    }
    private function afterTest()
    {
        $this->removerCobrancas();
        $this->removerPersonagens();
    }

    private function removerCobrancas()
    {
        Cobranca::truncate();
    }
    private function removerPersonagens()
    {
        Personagem::truncate();
    }
    
    public function test_lista()
    {
        $this->beforeTest();
        try {
            //preparação
            $personagens = Personagem::factory()->count(3)->create();
            foreach ($personagens as $key => $personagem) {
                $cobrancasPersonagem = Cobranca::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            //execução
            $personagemTeste = $personagens[0];
            $cobrancasTeste = $personagemTeste->cobrancas;

            $url = sprintf($this->url, $personagemTeste->id, '');
            $response = $this->getJson($url);

            //assert
            $response->assertStatus(200);
            $response->assertJsonCount(count($cobrancasTeste));
            $cobrancasResponse = $response->json();
            foreach ($cobrancasResponse as $key => $cobrancaArray) {
                $cobranca = $cobrancasTeste->find($cobrancaArray['id']);
                $this->assertEquals($cobrancaArray['titulo'], $cobranca->titulo);
                $this->assertEquals($cobrancaArray['texto'], $cobranca->texto);
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }

    }

    public function test_busca()
    {
        $this->beforeTest();
        try {
            //preparação
            $personagens = Personagem::factory()->count(3)->create();
            foreach ($personagens as $key => $personagem) {
                $cobrancasPersonagem = Cobranca::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            //execução
            $personagemTeste = $personagens[0];
            $cobrancaTeste = $personagemTeste->cobrancas;
            $cobrancaTeste = $cobrancaTeste->first();

            $url = sprintf($this->url, $personagemTeste->id, $cobrancaTeste->id);
            $response = $this->getJson($url);

            //assert
            $response->assertStatus(200);
            $cobrancaResponse = $response->json();
            $this->assertEquals($cobrancaResponse['titulo'], $cobrancaTeste->titulo);
            $this->assertEquals($cobrancaResponse['texto'], $cobrancaTeste->texto);
        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }

    }

    public function test_cria()
    {
        $this->beforeTest();
        try {
            //preparação
            $personagens = Personagem::factory()->count(3)->create();
            foreach ($personagens as $key => $personagem) {
                $cobrancasPersonagem = Cobranca::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            $requestData = [
                'titulo' => '$personagem->titulo',
                'texto' => '$personagem->texto',
                'datadesde' => (new DateTime())->format('Y-m-d H:i:s'),
                'lembrete' => (new DateTime())->format('Y-m-d H:i:s'),
            ];
            
            $personagemTeste = $personagens[0];

            $url = sprintf($this->url, $personagemTeste->id, '');
            $response = $this->postJson($url, $requestData);

            $response->assertStatus(201);
            $cobrancaResponse = $response->json();
            $this->assertEquals($cobrancaResponse['titulo'], $requestData['titulo']);
            $this->assertEquals($cobrancaResponse['texto'], $requestData['texto']);
            $this->assertEquals($cobrancaResponse['personagem_id'], $personagemTeste->id);

            $this->assertDatabaseHas(cobranca::TABLE, [
                'titulo' => $requestData['titulo'],
                'texto' => $requestData['texto'],
                'personagem_id' => $personagemTeste->id,
                'id' => $cobrancaResponse['id']
            ]);

        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }
    }
    
    public function test_edita()
    {
        $this->beforeTest();
        try {
            
            $personagens = Personagem::factory()->count(3)->create();
            foreach ($personagens as $key => $personagem) {
                $cobrancasPersonagem = Cobranca::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            $requestData = [
                'titulo' => 'personagem->titulo',
                'texto' => 'personagem->texto',
            ];
            
            $personagemTeste = $personagens[0];
            $cobrancaTeste = $personagemTeste->cobrancas->first();
            $cobrancaTeste->titulo .= '1';
            $cobrancaTeste->texto .= '2';
            $requestData = $cobrancaTeste->toArray();

            $url = sprintf($this->url, $personagemTeste->id, $cobrancaTeste->id);
            $response = $this->putJson($url, $requestData);

            $response->assertStatus(200);
            $cobrancaResponse = $response->json();
            $this->assertEquals($cobrancaResponse['titulo'], $requestData['titulo']);
            $this->assertEquals($cobrancaResponse['texto'], $requestData['texto']);
            $this->assertEquals($cobrancaResponse['personagem_id'], $personagemTeste->id);
            $this->assertDatabaseHas(Cobranca::TABLE, [
                'titulo' => $requestData['titulo'],
                'texto' => $requestData['texto'],
                'personagem_id' => $personagemTeste->id,
                'id' => $cobrancaTeste->id
            ]);

        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }
    }
    
    // public function test_editaIgnorandoCampoNaoPermitido()
    // {
    //     $this->beforeTest();
    //     try {
    //         $personagem = Personagem::factory()->create();
    //         $personagem->nome .= 1;
    //         $personagem->historia .= 2;
    //         $personagem->objetivos .= 3;
    //         $personagem->exp = 300;
    //         $requestData = $personagem->toArray();

    //         $url = sprintf('/api/personagens/%s', $personagem->id);
    //         $response = $this->putJson($url, $requestData);
    //         $personagemResponse = $response->json();

    //         $response->assertStatus(200);

    //         $this->assertEquals($personagemResponse['nome'], $personagem->nome);
    //         $this->assertEquals($personagemResponse['historia'], $personagem->historia);
    //         $this->assertEquals($personagemResponse['objetivos'], $personagem->objetivos);
    //         $this->assertEquals($personagemResponse['exp'], $personagem->getOriginal('exp'));
    //         $this->assertEquals($personagemResponse['exptotal'], $personagem->exptotal);
    //         $this->assertEquals($personagemResponse['ouro'], $personagem->ouro);
    //         $this->assertEquals($personagemResponse['ourototal'], $personagem->ourototal);
    //         $this->assertEquals($personagemResponse['nivel'], $personagem->nivel);
    //         $this->assertEquals($personagemResponse['prestigio'], $personagem->prestigio);

    //     } catch (Exception $e) {
    //         throw $e;
    //     } finally {
    //         $this->afterTest();
    //     }
    //     // Personagem::truncate();
    //     // $this->assertDatabaseHas('users', [
    //     //     'email' => 'sally@example.com',
    //     // ]);
    //     // $this->assertDatabaseMissing('users', [
    //     //     'email' => 'sally@example.com',
    //     // ]);
    // }
}
