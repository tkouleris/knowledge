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


    /**
     * @param array $data
     * @return Url
     */
    public function create(array $data): Url
    {
        return $this->model::create([
            'knowledge_id' => $data['knowledge_id'],
            'description' => $data['description'],
            'url' => $data['url']
        ]);
    }

    /**
     * @param int $id
     * @return Url
     */
    public function findById(int $id):Url
    {
        return $this->model::where('id',$id)->first();
    }

    /**
     * @param int $id
     * @return Url
     */
    public function delete(int $id): Url
    {
        $url = $this->model::where('id',$id)->first();
        if($url)
        {
            $url->delete();
        }
        return $url;
    }

    /**
     * @param array $data
     * @return Url
     */
    public function update(array $data): Url
    {
        $id = $data['id']??0;
        $url_record = $this->model::where('id',$id)->first();

        if(isset($data['url'])) $url_record->url = (string)$data['url'];
        if(isset($data['description'])) $url_record->url = (string)$data['description'];

        $url_record->save();

        return $url_record;
    }
}
