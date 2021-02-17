<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Repositories\Contracts\IVideoRepository;
use App\Services\VideoService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    use ApiResponse;

    private $videoService;

    /**
     * VideoController constructor.
     * @param $videoService
     */
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }


    public function create($id, Request $request, IVideoRepository $videoRepository)
    {
        $data['knowledge_id'] = $id;
        $data['url'] = $request->has('url')?$request->input('url'):'';
        $data['title'] = $request->has('title')?$request->input('title'):'';
        $data['description'] = $request->has('description')?$request->input('description'):"";
        $video = $videoRepository->create($data);

        return new Response($this->success($video,"created"),201);
    }
}
