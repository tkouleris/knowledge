<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ImageRequest;
use App\Services\ImageService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    use ApiResponse;

    protected $ImageService;

    /**
     * ImageController constructor.
     * @param ImageService $ImageService
     */
    public function __construct(ImageService $ImageService)
    {
        parent::__construct();
        $this->ImageService = $ImageService;
    }

    /**
     * @param ImageRequest $request
     * @return Response
     */
    public function ImageUpload(ImageRequest $request): Response
    {
        $imageName = $this->ImageService->AvatarImageUpload($request, auth()->user()->id);

        return new Response($this->success($imageName,"avatar uploaded"),200);
    }
}
