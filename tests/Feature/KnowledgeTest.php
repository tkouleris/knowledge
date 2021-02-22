<?php

namespace Tests\Feature;

use App\Models\Knowledge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KnowledgeTest extends TestCase
{
    use RefreshDatabase;
    use Helpers;

    /**
     * @test
     */
    public function knowledge_record_created()
    {
        $token = $this->getToken();

        $response = $this->post('api/knowledge/create',[],['HTTP_Authorization' => 'Bearer '.$token['token']]);
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
        $this->create_single_knowledge_record();

        $token = $this->getToken();
        $response = $this->get('api/knowledge/1',['HTTP_Authorization' => 'Bearer '.$token['token']]);
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
        $this->create_single_knowledge_record();

        $data['title'] = "test title";
        $data['description'] = "test description";
        $token = $this->getToken();
        $response = $this->call(
            'POST',
            'api/knowledge/1',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_Authorization' => 'Bearer '.$token['token']
            ],
            $json = json_encode($data)
        );

        $knowledgeUpdated = Knowledge::where('id',1)->first();
        $this->assertEquals("test title",$knowledgeUpdated->title);
        $this->assertEquals("test description",$knowledgeUpdated->description);
        $response->assertStatus(200);
    }


    /**
     * @test
     */
    public function knowledge_record_deleted()
    {
        $this->create_single_knowledge_record();
        $knowledge_collection = Knowledge::all();
        $this->assertEquals(1,$knowledge_collection->count());

        $data['title'] = "test title";
        $data['description'] = "test description";
        $token = $this->getToken();
        $response = $this->call(
            'DELETE',
            'api/knowledge/1',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_Authorization' => 'Bearer '.$token['token']
            ],
            null
        );

        $knowledge_collection = Knowledge::all();
        $this->assertEquals(0,$knowledge_collection->count());
        $response->assertStatus(204);
    }

}
