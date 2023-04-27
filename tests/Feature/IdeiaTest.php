<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use App\Models\Ideia;
use App\Models\Personagem;

class IdeiaTest extends TestCase
{

    protected $url = '/api/%s/ideias/%s';

    private function beforeTest()
    {
        // $this->removerPersonagens();
    }
    private function afterTest()
    {
        $this->removerIdeias();
        $this->removerPersonagens();
    }

    private function removerIdeias()
    {
        Ideia::truncate();
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
                $ideiasPersonagem = Ideia::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            //execução
            $personagemTeste = $personagens[0];
            $ideiasTeste = $personagemTeste->ideias;

            $url = sprintf($this->url, $personagemTeste->id, '');
            $response = $this->getJson($url);

            //assert
            $response->assertStatus(200);
            $response->assertJsonCount(count($ideiasTeste));
            $ideiasResponse = $response->json();
            foreach ($ideiasResponse as $key => $ideiaArray) {
                $ideia = $ideiasTeste->find($ideiaArray['id']);
                $this->assertEquals($ideiaArray['titulo'], $ideia->titulo);
                $this->assertEquals($ideiaArray['texto'], $ideia->texto);
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
                $ideiasPersonagem = Ideia::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            //execução
            $personagemTeste = $personagens[0];
            $ideiaTeste = $personagemTeste->ideias;
            $ideiaTeste = $ideiaTeste->first();

            $url = sprintf($this->url, $personagemTeste->id, $ideiaTeste->id);
            $response = $this->getJson($url);

            //assert
            $response->assertStatus(200);
            $ideiaResponse = $response->json();
            $this->assertEquals($ideiaResponse['titulo'], $ideiaTeste->titulo);
            $this->assertEquals($ideiaResponse['texto'], $ideiaTeste->texto);
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
                $ideiasPersonagem = Ideia::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            $requestData = [
                'titulo' => '$personagem->titulo',
                'texto' => '$personagem->texto',
            ];
            
            $personagemTeste = $personagens[0];

            $url = sprintf($this->url, $personagemTeste->id , '');
            $response = $this->postJson($url, $requestData);

            $response->assertStatus(201);
            $ideiaResponse = $response->json();
            $this->assertEquals($ideiaResponse['titulo'], $requestData['titulo']);
            $this->assertEquals($ideiaResponse['texto'], $requestData['texto']);
            $this->assertEquals($ideiaResponse['personagem_id'], $personagemTeste->id);

            $this->assertDatabaseHas(Ideia::TABLE, [
                'titulo' => $requestData['titulo'],
                'texto' => $requestData['texto'],
                'personagem_id' => $personagemTeste->id,
                'id' => $ideiaResponse['id']
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
                $ideiasPersonagem = Ideia::factory()->count(3)->create(['personagem_id' => $personagem->id]);
            }

            $requestData = [
                'titulo' => 'personagem->titulo',
                'texto' => 'personagem->texto',
            ];
            
            $personagemTeste = $personagens[0];
            $ideiaTeste = $personagemTeste->ideias->first();
            $ideiaTeste->titulo .= '1';
            $ideiaTeste->texto .= '2';
            $requestData = $ideiaTeste->toArray();

            $url = sprintf($this->url, $personagemTeste->id, $ideiaTeste->id);
            $response = $this->putJson($url, $requestData);

            $response->assertStatus(200);
            $ideiaResponse = $response->json();
            $this->assertEquals($ideiaResponse['titulo'], $requestData['titulo']);
            $this->assertEquals($ideiaResponse['texto'], $requestData['texto']);
            $this->assertEquals($ideiaResponse['personagem_id'], $personagemTeste->id);
            $this->assertDatabaseHas(Ideia::TABLE, [
                'titulo' => $requestData['titulo'],
                'texto' => $requestData['texto'],
                'personagem_id' => $personagemTeste->id,
                'id' => $ideiaTeste->id
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
