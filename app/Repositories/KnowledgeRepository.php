<?php


namespace App\Repositories;


use App\Models\Knowledge;
use App\Repositories\Contracts\IKnowledgeRepository;

class KnowledgeRepository implements IKnowledgeRepository
{
    private $model;

    /**
     * KnowledgeRepository constructor.
     * @param $model
     */
    public function __construct(Knowledge $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $data
     * @return Knowledge
     */
    public function create(array $data): Knowledge
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return Knowledge
     */
    public function findById(int $id): Knowledge
    {
        return $this->model::where('id',$id)->first();
    }

    public function update(array $data): Knowledge
    {
        $knowledge = Knowledge::where('id',$data['id'])->first();
        if(isset($data['title'])) $knowledge->title = $data['title'];
        if(isset($data['description'])) $knowledge->description = $data['description'];
        $knowledge->save();
        return $knowledge;
    }
}
