<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\KnowledgeService;
use App\Traits\ApiResponse;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    use ApiResponse;

    private $knowledgeService;

    /**
     * KnowledgeController constructor.
     * @param $knowledgeService
     */
    public function __construct(KnowledgeService $knowledgeService)
    {
        $this->knowledgeService = $knowledgeService;
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        /** @var User $currentUser */
        $currentUser = auth()->user();
        $knowledge = $this->knowledgeService->createDefaultRecord($currentUser);
        return new Response($this->success($knowledge,"record created"),201);
    }

    /**
     * @param int $id
     * @return Response
     * @throws \App\Exceptions\KnowledgeNotFoundException
     */
    public function show(int $id): Response
    {
        /** @var User $user */
        $user = Auth::user();
        $found_record = $this->knowledgeService->show($id, $user);
        return new Response($this->success($found_record,"record"),200);
    }


    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request): Response
    {
        $data = $request->input();
        $data['id'] = $id;
        $updatedKnowledge = $this->knowledgeService->update($data);
        return new Response($this->success($updatedKnowledge,"record"),200);
    }

    /**
     * @param $id
     * @return Response
     * @throws \App\Exceptions\KnowledgeNotFoundException
     */
    public function delete($id): Response
    {
        $knowledge = $this->knowledgeService->delete($id);
        return new Response($this->success($knowledge,"record deleted"),204);
    }

    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $searchTags = [];
        if($request->has('tag_search')){
            $searchTags = explode(",",$request->input('tag_search'));
        }
        return new Response(
            $this->success($this->knowledgeService->findByTags($user, $searchTags)
            ,"knowledge index")
            ,200
        );
    }


}
