<?php


namespace Tests\Feature;


use App\Models\Knowledge;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    use Helpers;

    /**
     * @test
     */
    public function create_video_for_knowledge(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);

        $data['url'] = "http://youtube.com/";
        $data['title'] = "My Video";
        $data['description'] = "Video Description";
        $token = $this->getToken();
        $response = $this->call(
            'POST',
            'api/knowledge/'.$knowledge->id.'/video',
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
        $video_response = json_decode($response->getContent());

        $this->assertEquals(1,Video::all()->count());
        $this->assertEquals($knowledge->id,$video_response->data->knowledge_id);
        $this->assertEquals($data['url'],$video_response->data->url);
        $this->assertEquals($data['title'],$video_response->data->title);
        $this->assertEquals($data['description'],$video_response->data->description);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function delete_video_for_knowledge(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);
        $video_record = Video::create([
            'knowledge_id' => $knowledge->id,
            'url' => 'http://www.google.com',
            'title' => 'title',
            'description' => 'description',
        ]);

        $token = $this->getToken();
        $response = $this->call(
            'DELETE',
            'api/knowledge/'.$knowledge->id.'/video/'.$video_record->id,
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

        $this->assertEquals(0,Video::all()->count());
        $response->assertStatus(204);
    }

    /**
     * @test
     */
    public function show_video_record(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);
        $video_record = Video::create([
            'knowledge_id' => $knowledge->id,
            'url' => 'http://www.google.com',
            'title' => 'title',
            'description' => 'description',
        ]);

        $token = $this->getToken();
        $response = $this->call(
            'GET',
            'api/knowledge/'.$knowledge->id.'/video/'.$video_record->id,
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


        $video_response = json_decode($response->getContent());
        $this->assertEquals(1,Video::all()->count());
        $this->assertEquals($knowledge->id,$video_response->data->knowledge_id);
        $this->assertEquals('http://www.google.com',$video_response->data->url);
        $this->assertEquals('title',$video_response->data->title);
        $this->assertEquals('description',$video_response->data->description);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update_video_record(): void
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);
        $video_record = Video::create([
            'knowledge_id' => $knowledge->id,
            'url' => 'http://www.google.com',
            'title' => 'title',
            'description' => 'description',
        ]);

        $data['title'] = "updated_title";
        $data['url'] = "updated_url";
        $data['description'] = "updated_description";
        $token = $this->getToken();
        $response = $this->call(
            'PUT',
            'api/knowledge/'.$knowledge->id.'/video/'.$video_record->id,
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
        $video_response = json_decode($response->getContent());

        $this->assertEquals(1,Video::all()->count());
        $this->assertEquals($knowledge->id,$video_response->data->knowledge_id);
        $this->assertEquals($data['url'],$video_response->data->url);
        $this->assertEquals($data['title'],$video_response->data->title);
        $this->assertEquals($data['description'],$video_response->data->description);
        $response->assertStatus(200);
    }
}
