<?php

namespace Tests\Feature;

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

        $inserted_knowledge_response = json_decode($response->getContent());
        $this->assertEquals( "Untitled knowledge", $inserted_knowledge_response->data->title);
        $this->assertEquals("Untitled knowledge", $inserted_knowledge_response->data->title);
        $this->assertTrue($inserted_knowledge_response->success);
        $response->assertStatus(201);

    }
}
