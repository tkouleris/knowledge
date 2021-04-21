<?php


namespace App\Services;


use App\Models\Video;
use App\Repositories\Contracts\IVideoRepository;

class VideoService
{

    /**
     * @var IVideoRepository
     */
    private $videoRepository;


    /**
     * VideoService constructor.
     * @param IVideoRepository $videoRepository
     */
    public function __construct(IVideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * @param array $data
     * @return Video
     */
    public function create(array $data): Video
    {
        $data['url'] = $data['url']??'';
        $data['title'] = $data['title']??"";
        $data['description'] = $data['description']??"";

        return $this->videoRepository->create($data);
    }

    /**
     * @param int $video_id
     * @return Video
     */
    public function delete(int $video_id): Video
    {
        return $this->videoRepository->delete($video_id);
    }

    public function findById(int $id):Video
    {
        return $this->videoRepository->findById($id);
    }

    public function update(array $data)
    {
        return $this->videoRepository->update($data);
    }
}
