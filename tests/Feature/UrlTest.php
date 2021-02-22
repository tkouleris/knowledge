<?php


namespace Tests\Feature;


use App\Models\Knowledge;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UrlTest extends TestCase
{
    use RefreshDatabase;
    use Helpers;

    /**
     * @test
     */
    public function create_url_for_knowledge()
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);

        $token = $this->getToken();
        $data['url'] = "http://www.google.com";
        $response = $this->call(
            'POST',
            'api/knowledge/'.$knowledge->id.'/url',
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
        $url_response = json_decode($response->getContent());

        $this->assertEquals($knowledge->id,$url_response->data->knowledge_id);
        $this->assertEquals("http://www.google.com",$url_response->data->url);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function delete_url_for_knowledge(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);
        $url = Url::create([
            'knowledge_id' => $knowledge->id,
            'url' => 'http://www.google.com'
        ]);

        $token = $this->getToken();
        $response = $this->call(
            'DELETE',
            'api/knowledge/'.$knowledge->id.'/url/'.$url->id,
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

        $url_collection = Url::all();
        $this->assertEquals(0,$url_collection->count());
        $response->assertStatus(204);
    }

    /**
     * @test
     */
    public function show_url_for_knowledge(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);
        $url = Url::create([
            'knowledge_id' => $knowledge->id,
            'url' => 'http://www.google.com'
        ]);

        $token = $this->getToken();
        $response = $this->call(
            'GET',
            'api/knowledge/'.$knowledge->id.'/url/'.$url->id,
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
        $url_response = json_decode($response->getContent());

        $this->assertEquals('http://www.google.com', $url_response->data->url);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update_url_for_knowledge(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);
        $url = Url::create([
            'knowledge_id' => $knowledge->id,
            'url' => 'http://www.google.com'
        ]);

        $data['url'] = "http://www.google.gr";
        $token = $this->getToken();
        $response = $this->call(
            'PUT',
            'api/knowledge/'.$knowledge->id.'/url/'.$url->id,
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

        $url_response = json_decode($response->getContent());

        $this->assertEquals('http://www.google.gr', $url_response->data->url);
        $response->assertStatus(200);
    }
}
