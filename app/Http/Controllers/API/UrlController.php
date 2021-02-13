<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $data['description'] = $request->has('description')?$request->input('description'):"";
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

    /**
     * @param $id
     * @param $url_id
     * @return Response
     */
    public function show($id, $url_id): Response
    {
        $url_record = $this->urlService->find($url_id);
        return new Response($this->success($url_record,"record"),200);
    }

    /**
     * @param $id
     * @param $url_id
     * @param Request $request
     * @return Response
     */
    public function update($id, $url_id, Request $request): Response
    {
        $data = $request->all();
        $data['id'] = $url_id;
        $updateUrl = $this->urlService->update($data);
        return new Response($this->success($updateUrl,"record"),200);
    }
}
