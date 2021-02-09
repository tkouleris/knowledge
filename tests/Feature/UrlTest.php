<?php


namespace Tests\Feature;


use App\Models\Knowledge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_url_for_knowledge()
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);


        $data['url'] = "http://www.google.com";
        $response = $this->call(
            'POST',
            'api/knowledge/'.$knowledge->id.'/url',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
            ],
            $json = json_encode($data)
        );
        $url_response = json_decode($response->getContent());

        $this->assertEquals($knowledge->id,$url_response->data->knowledge_id);
        $this->assertEquals("http://www.google.com",$url_response->data->url);
        $response->assertStatus(201);

    }
}
