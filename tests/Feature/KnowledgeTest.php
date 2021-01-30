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
        $json = $response->decodeResponseJson();

        $this->assertEquals( "Untitled knowledge", $json['data']['title']);
        $this->assertEquals("No description", $json['data']['description']);
        $this->assertTrue($json['success']);
        $response->assertStatus(201);
    }
}
