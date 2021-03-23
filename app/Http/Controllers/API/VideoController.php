<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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


    /**
     * @param $id
     * @param Request $request
     * @param IVideoRepository $videoRepository
     * @return Response
     */
    public function create($id, Request $request, IVideoRepository $videoRepository): Response
    {
        $data['knowledge_id'] = $id;
        $data['url'] = ($request->has('url') && $request->input('url') !== null)?$request->input('url'):'';
        $data['title'] = ($request->has('title') && $request->input('title')!==null)?$request->input('title'):'';
        $data['description'] = ($request->has('description') && $request->input('description') !== null)?$request->input('description'):"";
        $video = $videoRepository->create($data);

        return new Response($this->success($video,"created"),201);
    }

    /**
     * @param $id
     * @param $video_id
     * @return Response
     */
    public function delete($id, $video_id): Response
    {
        $video = $this->videoService->delete($video_id);
        return new Response($this->success($video,"deleted"),204);
    }

    /**
     * @param $id
     * @param $video_id
     * @return Response
     */
    public function show($id, $video_id): Response
    {
        $video = $this->videoService->findById($video_id);
        return new Response($this->success($video,"record"),200);
    }

    /**
     * @param $id
     * @param $video_id
     * @param Request $request
     * @return Response
     */
    public function update($id, $video_id, Request $request): Response
    {
        $data = $request->all();
        $data['id'] = $video_id;
        $video = $this->videoService->update($data);
        return new Response($this->success($video,"record"),200);
    }
}
