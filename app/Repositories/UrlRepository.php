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
        return $this->model::create([
            'knowledge_id' => $data['knowledge_id'],
            'url' => $data['url']
        ]);
    }

    public function findById(int $id):Url
    {
        return $this->model::where('id',$id)->first();
    }

    public function delete(int $id): Url
    {
        $url = $this->model::where('id',$id)->first();
        if($url)
        {
            $url->delete();
        }
        return $url;
    }
}
