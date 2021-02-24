<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TagService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    use ApiResponse;

    private $tagService;

    /**
     * TagController constructor.
     * @param $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }


    /**
     * @return Response
     */
    public function create(): Response
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $tag = $this->tagService->create([],$currentUser);
        return new Response($this->success($tag,"created"),201);
    }

    /**
     * @param $id
     * @return Response
     */
    public function delete($id): Response
    {
        $tag = $this->tagService->delete($id);
        return new Response($this->success($tag,"created"),204);
    }

    /**
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        $tag = $this->tagService->findById($id);
        return new Response($this->success($tag,"created"),200);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $data['id'] = $id;
        $tag = $this->tagService->update($data);
        return new Response($this->success($tag,"created"),200);
    }
}
