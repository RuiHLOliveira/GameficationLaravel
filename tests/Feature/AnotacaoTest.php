<?php

namespace Tests\Feature;

use DateTime;
use Exception;
use Tests\TestCase;
use App\Models\Anotacao;
use App\Models\Personagem;

class AnotacaoTest extends TestCase
{

    protected $url = '/api/%s/anotacoes/%s';

    private function beforeTest()
    {
        // $this->removerPersonagens();
    }
    private function afterTest()
    {
        $this->removerAnotacoes();
        $this->removerPersonagens();
    }

    private function removerAnotacoes()
    {
        Anotacao::truncate();
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
                $anotacoesPersonagem = Anotacao::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            //execução
            $personagemTeste = $personagens[0];
            $anotacoesTeste = $personagemTeste->anotacoes;

            $url = sprintf($this->url, $personagemTeste->id, '');
            $response = $this->getJson($url);

            //assert
            $response->assertStatus(200);
            $response->assertJsonCount(count($anotacoesTeste));
            $anotacoesResponse = $response->json();
            foreach ($anotacoesResponse as $key => $anotacaoArray) {
                $anotacao = $anotacoesTeste->find($anotacaoArray['id']);
                $this->assertEquals($anotacaoArray['lembrete'], $anotacao->lembrete);
                $this->assertEquals($anotacaoArray['texto'], $anotacao->texto);
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
                $anotacoesPersonagem = Anotacao::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            //execução
            $personagemTeste = $personagens[0];
            $anotacaoTeste = $personagemTeste->anotacoes;
            $anotacaoTeste = $anotacaoTeste->first();

            $url = sprintf($this->url, $personagemTeste->id, $anotacaoTeste->id);
            $response = $this->getJson($url);

            //assert
            $response->assertStatus(200);
            $anotacaoResponse = $response->json();
            $this->assertEquals($anotacaoResponse['lembrete'], $anotacaoTeste->lembrete);
            $this->assertEquals($anotacaoResponse['texto'], $anotacaoTeste->texto);
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
                $anotacoesPersonagem = Anotacao::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            $requestData = [
                'texto' => '$personagem->texto',
                'lembrete' => (new DateTime())->format('Y-m-d H:i:s'),
            ];
            
            $personagemTeste = $personagens[0];

            $url = sprintf($this->url, $personagemTeste->id , '');
            $response = $this->postJson($url, $requestData);

            $response->assertStatus(201);
            $anotacaoResponse = $response->json();
            $this->assertEquals($anotacaoResponse['texto'], $requestData['texto']);
            $this->assertEquals($anotacaoResponse['lembrete'], $requestData['lembrete']);
            $this->assertEquals($anotacaoResponse['personagem_id'], $personagemTeste->id);

            $this->assertDatabaseHas(Anotacao::TABLE, [
                'texto' => $requestData['texto'],
                'personagem_id' => $personagemTeste->id,
                'id' => $anotacaoResponse['id']
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
                $anotacoesPersonagem = Anotacao::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            $requestData = [
                'texto' => 'personagem->texto',
                'lembrete' => (new DateTime())->format('Y-m-d H:i:s'),
            ];
            
            $personagemTeste = $personagens[0];
            $anotacaoTeste = $personagemTeste->anotacoes->first();
            $anotacaoTeste->texto .= '2';
            $requestData = $anotacaoTeste->toArray();
            //falta o lembrete

            $url = sprintf($this->url, $personagemTeste->id, $anotacaoTeste->id);
            $response = $this->putJson($url, $requestData);

            $response->assertStatus(200);
            $anotacaoResponse = $response->json();
            $this->assertEquals($anotacaoResponse['lembrete'], $requestData['lembrete']);
            $this->assertEquals($anotacaoResponse['texto'], $requestData['texto']);
            $this->assertEquals($anotacaoResponse['personagem_id'], $personagemTeste->id);
            $this->assertDatabaseHas(Anotacao::TABLE, [
                'lembrete' => $requestData['lembrete'],
                'texto' => $requestData['texto'],
                'personagem_id' => $personagemTeste->id,
                'id' => $anotacaoTeste->id
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
