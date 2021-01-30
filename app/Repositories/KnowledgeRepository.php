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


    public function create($data): Knowledge
    {
        return $this->model->create($data);
    }

    public function findById($id): Knowledge
    {
        return $this->model::where('id',$id)->first();
    }
}
