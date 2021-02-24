<?php


namespace App\Repositories;


use App\Models\Video;
use App\Repositories\Contracts\IVideoRepository;

class VideoRepository implements IVideoRepository
{
    /**
     * @var Video
     */
    private $model;

    /**
     * VideoRepository constructor.
     * @param $model
     */
    public function __construct(Video $model)
    {
        $this->model = $model;
    }


    public function create(array $data): Video
    {
        return $this->model->create( $data );
    }

    /**
     * @param $id
     * @return Video
     */
    public function delete(int $id):Video
    {
        $video = $this->model::where('id',$id)->first();
        if($video)
        {
            $video->delete();
        }
        return $video;
    }

    public function findById(int $id): Video
    {
        return $this->model::where('id',$id)->first();
    }

    public function update(array $data): Video
    {
        $id = $data['id']??0;
        $video_record = $this->model::where('id',$id)->first();

        if(isset($data['title'])) $video_record->title = (string)$data['title'];
        if(isset($data['url'])) $video_record->url = (string)$data['url'];
        if(isset($data['description'])) $video_record->description = (string)$data['description'];

        $video_record->save();

        return $video_record;
    }
}
