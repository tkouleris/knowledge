<?php


namespace App\Repositories;


use App\Models\Video;
use App\Repositories\Contracts\IVideoRepository;

class VideoRepository implements IVideoRepository
{
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
}
