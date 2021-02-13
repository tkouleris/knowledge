<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\UrlService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UrlController extends Controller
{
    use ApiResponse;

    private $urlService;

    /**
     * UrlController constructor.
     * @param $urlService
     */
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }


    /**
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function create($id, Request $request): Response
    {
        $data['knowledge_id'] = $id;
        $data['url'] = $request->has('url')?$request->input('url'):'';
        $url = $this->urlService->create($data);

        return new Response($this->success($url,"created"),201);
    }

    /**
     * @param $id
     * @param $url_id
     * @return Response
     */
    public function delete($id, $url_id): Response
    {
        $url = $this->urlService->delete($url_id);
        return new Response($this->success($url,"deleted"),204);
    }

    public function show($id, $url_id)
    {
        $url_record = $this->urlService->find($url_id);
        return new Response($this->success($url_record,"record"),200);
    }
}
