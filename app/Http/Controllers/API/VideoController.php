<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    use ApiResponse;

    public function create($id, Request $request)
    {
        $data['knowledge_id'] = $id;
        $data['url'] = $request->has('url')?$request->input('url'):'';
        $data['title'] = $request->has('title')?$request->input('title'):'';
        $data['description'] = $request->has('description')?$request->input('description'):"";

        $video = Video::create(
            $data
        );


        return new Response($this->success($video,"created"),201);
    }
}
