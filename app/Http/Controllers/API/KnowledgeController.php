<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Knowledge;
use App\Repositories\Contracts\IKnowledgeRepository;
use App\Services\KnowledgeService;
use App\Traits\ApiResponse;
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
        $knowledge = $this->knowledgeService->createDefaultRecord();
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

    public function update($id, Request $request, IKnowledgeRepository $knowledgeRepository)
    {
        $data = $request->input();
        $data['id'] = $id;
        return $knowledgeRepository->update($data);
    }
}
