<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Knowledge;
use App\Repositories\KnowledgeRepository;
use App\Services\KnowledgeService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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


    public function create()
    {
        $knowledge = $this->knowledgeService->createDefaultRecord();
        return new Response($this->success($knowledge,"record created"),201);
    }
}
