<?php

namespace Tests\Feature;

use App\Models\Knowledge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KnowledgeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function knowledge_record_created()
    {
        $response = $this->post('api/knowledge/create');
        $json = $response->decodeResponseJson();

        $this->assertEquals( "Untitled knowledge", $json['data']['title']);
        $this->assertEquals("No description", $json['data']['description']);
        $this->assertTrue($json['success']);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function knowledge_record_exists()
    {
        $this->create_single_record();

        $response = $this->get('api/knowledge/1');
        $json = $response->decodeResponseJson();



        $this->assertEquals( "Untitled knowledge", $json['data']['title']);
        $this->assertEquals("No description", $json['data']['description']);
        $this->assertTrue($json['success'],true);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function knowledge_record_updated()
    {
        $this->create_single_record();
//        $knowledge = Knowledge::where('id',1);

        $data['title'] = "test title";
        $data['description'] = "test description";
        $response = $this->call(
            'POST',
            'api/knowledge/1',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
            ],
            $json = json_encode($data)
        );

        $knowledgeUpdated = Knowledge::where('id',1)->first();
        $this->assertEquals("test title",$knowledgeUpdated->title);
        $this->assertEquals("test description",$knowledgeUpdated->description);
        $response->assertStatus(200);
    }

    private function create_single_record()
    {
        $knowledge = new Knowledge();
        $knowledge->title = "Untitled knowledge";
        $knowledge->description = "No description";
        $knowledge->save();
    }

}
