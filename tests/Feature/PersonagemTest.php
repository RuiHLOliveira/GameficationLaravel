<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Personagem;
use Exception;

class PersonagemTest extends TestCase
{
    // use RefreshDatabase;
    // $this->afterApplicationCreated(function () {
    //$this->beforeApplicationDestroyed(function () {

    private function beforeTest()
    {
        // $this->removerPersonagens();
    }
    private function afterTest()
    {
        $this->removerPersonagens();
    }

    private function removerPersonagens()
    {
        Personagem::truncate();
    }
    
    // /**
    //  * @after
    //  */
    // public function removePersonagem1()
    // {
    //     $this->beforeApplicationDestroyed(function () {
    //         Personagem::truncate();
    //         var_dump("### truncate");
    //     });
    // }

    public function test_lista()
    {
        $this->beforeTest();
        $personagens = Personagem::factory()->count(3)->create();

        try {
            $url = '/api/personagens/';
            $response = $this->getJson($url);

            $response->assertStatus(200);
            $response->assertJsonCount(count($personagens));

            $personagensResponse = $response->json();
            foreach ($personagensResponse as $key => $personagemArray) {
                $personagem = $personagens->find($personagemArray['id']);
                $this->assertEquals($personagemArray['nome'], $personagem->nome);
                $this->assertEquals($personagemArray['historia'], $personagem->historia);
                $this->assertEquals($personagemArray['objetivos'], $personagem->objetivos);
                $this->assertEquals($personagemArray['nivel'], $personagem->nivel);
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }
        // Personagem::truncate();

        // $this->assertDatabaseHas('users', [
        //     'email' => 'sally@example.com',
        // ]);
        // $this->assertDatabaseMissing('users', [
        //     'email' => 'sally@example.com',
        // ]);
    }

    public function test_busca()
    {
        $this->beforeTest();
        try {
            $personagens[] = Personagem::factory()->create();
            $personagens[] = Personagem::factory()->create();
            $personagens[] = Personagem::factory()->create();

            $url = sprintf('/api/personagens/%s', $personagens[0]->id);
            $response = $this->getJson($url);

            $response->assertStatus(200);
            
            $personagemResponse = $response->json();
            $personagem = $personagens[0];
            $this->assertEquals($personagemResponse['nome'], $personagem->nome);
            $this->assertEquals($personagemResponse['historia'], $personagem->historia);
            $this->assertEquals($personagemResponse['objetivos'], $personagem->objetivos);
            $this->assertEquals($personagemResponse['nivel'], $personagem->nivel);
        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }

        // Personagem::truncate();
        // $this->assertDatabaseHas('users', [
        //     'email' => 'sally@example.com',
        // ]);
        // $this->assertDatabaseMissing('users', [
        //     'email' => 'sally@example.com',
        // ]);
    }

    public function test_cria()
    {
        $this->beforeTest();
        try {
            $personagem = Personagem::factory()->make();

            // dd(json_encode($personagem));

            $requestData = [
                'nome' => $personagem->nome,
                'historia' => $personagem->historia,
                'objetivos' => $personagem->objetivos,
            ];

            $url = '/api/personagens/';
            $response = $this->postJson($url, $requestData);
            $personagemResponse = $response->json();
            $response->assertStatus(201);

            $this->assertEquals($personagemResponse['nome'], $personagem->nome);
            $this->assertEquals($personagemResponse['historia'], $personagem->historia);
            $this->assertEquals($personagemResponse['objetivos'], $personagem->objetivos);
            $this->assertEquals($personagemResponse['nivel'], $personagem->nivel);

        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }
        // Personagem::truncate();
        // $this->assertDatabaseHas('users', [
        //     'email' => 'sally@example.com',
        // ]);
        // $this->assertDatabaseMissing('users', [
        //     'email' => 'sally@example.com',
        // ]);
    }
    
    public function test_edita()
    {
        $this->beforeTest();
        try {
            $personagem = Personagem::factory()->create();
            $personagem->nome .= 1;
            $personagem->historia .= 2;
            $personagem->objetivos .= 3;
            $requestData = $personagem->toArray();

            $url = sprintf('/api/personagens/%s', $personagem->id);
            $response = $this->putJson($url, $requestData);
            $personagemResponse = $response->json();

            $response->assertStatus(200);

            $this->assertEquals($personagemResponse['nome'], $personagem->nome);
            $this->assertEquals($personagemResponse['historia'], $personagem->historia);
            $this->assertEquals($personagemResponse['objetivos'], $personagem->objetivos);
            $this->assertEquals($personagemResponse['nivel'], $personagem->nivel);

        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }
        // Personagem::truncate();
        // $this->assertDatabaseHas('users', [
        //     'email' => 'sally@example.com',
        // ]);
        // $this->assertDatabaseMissing('users', [
        //     'email' => 'sally@example.com',
        // ]);
    }
    
    public function test_editaIgnorandoCampoNaoPermitido()
    {
        $this->beforeTest();
        try {
            $personagem = Personagem::factory()->create();
            $personagem->nome .= 1;
            $personagem->historia .= 2;
            $personagem->objetivos .= 3;
            $personagem->exp = 300;
            $requestData = $personagem->toArray();

            $url = sprintf('/api/personagens/%s', $personagem->id);
            $response = $this->putJson($url, $requestData);
            $personagemResponse = $response->json();

            $response->assertStatus(200);

            $this->assertEquals($personagemResponse['nome'], $personagem->nome);
            $this->assertEquals($personagemResponse['historia'], $personagem->historia);
            $this->assertEquals($personagemResponse['objetivos'], $personagem->objetivos);
            $this->assertEquals($personagemResponse['nivel'], $personagem->nivel);

        } catch (Exception $e) {
            throw $e;
        } finally {
            $this->afterTest();
        }
        // Personagem::truncate();
        // $this->assertDatabaseHas('users', [
        //     'email' => 'sally@example.com',
        // ]);
        // $this->assertDatabaseMissing('users', [
        //     'email' => 'sally@example.com',
        // ]);
    }
}
