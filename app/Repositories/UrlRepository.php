<?php


namespace App\Repositories;


use App\Models\Url;
use App\Repositories\Contracts\IUrlRepository;

class UrlRepository implements IUrlRepository
{
    private $model;

    /**
     * UrlRepository constructor.
     * @param $model
     */
    public function __construct(Url $model)
    {
        $this->model = $model;
    }


    public function create(array $data): Url
    {
        return Url::create([
            'knowledge_id' => $data['knowledge_id'],
            'url' => $data['url']
        ]);
    }
}
