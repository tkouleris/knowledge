<?php


namespace Tests\Feature;


use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    use Helpers;

    /**
     * @test
     */
    public function use_creates_a_new_tag()
    {
        $token = $this->getToken();
        $response = $this->call(
            'POST',
            'api/tag/create',
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
        $tag_response = json_decode($response->getContent());


        $this->assertEquals('Untitled tag', $tag_response->data->tag);
        $this->assertEquals($token['id'], $tag_response->data->user_id);
        $this->assertTrue($tag_response->success);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function delete_tag()
    {
        $token = $this->getToken();
        $this->create_single_tag($token['id']);
        $tag_collection = Tag::all();
        $tag_collection[0]->id;

        $response = $this->call(
            'DELETE',
            'api/tag/'.$tag_collection[0]->id,
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


        $tag_collection = Tag::all();
        $this->assertEquals(0,$tag_collection->count());
        $response->assertStatus(204);
    }

    /**
     * @test
     */
    public function show_a_tag()
    {
        $token = $this->getToken();
        $this->create_single_tag($token['id']);
        $tag_collection = Tag::all();
        $tag_collection[0]->id;

        $response = $this->call(
            'GET',
            'api/tag/'.$tag_collection[0]->id,
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
        $tag_response = json_decode($response->getContent());

        $this->assertEquals($tag_collection[0]->tag,$tag_response->data->tag);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update_a_tag()
    {
        $token = $this->getToken();
        $this->create_single_tag($token['id']);
        $tag_collection = Tag::all();
        $tag_collection[0]->id;

        $data['tag'] = "my tag";
        $response = $this->call(
            'PUT',
            'api/tag/'.$tag_collection[0]->id,
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
        $tag_response = json_decode($response->getContent());

        $this->assertEquals($data['tag'],$tag_response->data->tag);
        $response->assertStatus(200);
    }

    /**
     * @param $id
     */
    private function create_single_tag($id): void
    {
        $tag = new Tag();
        $tag->tag = 'tag name';
        $tag->user_id = $id;
        $tag->save();
    }



}
