<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\KnowledgeService;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;

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
     */
    public function show(int $id): Response
    {
        $found_record = $this->knowledgeService->show($id);
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
     */
    public function delete($id): Response
    {
        $knowledge = $this->knowledgeService->delete($id);
        return new Response($this->success($knowledge,"record deleted"),204);
    }
}
