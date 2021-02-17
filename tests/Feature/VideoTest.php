<?php


namespace Tests\Feature;


use App\Models\Knowledge;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_video_for_knowledge()
    {
        $knowledge = Knowledge::create([
            'title' => "Untitled",
            'description' => "no descritpion"
        ]);

        $data['url'] = "http://youtube.com/";
        $data['title'] = "My Video";
        $data['description'] = "Video Description";
        $response = $this->call(
            'POST',
            'api/knowledge/'.$knowledge->id.'/video',
            [],
            [],
            [],
            $headers = [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json'
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
}
