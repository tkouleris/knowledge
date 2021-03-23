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
        return $this->model::create($data);
    }

    /**
     * @param int $id
     * @return Knowledge
     */
    public function findById(int $id): Knowledge
    {
        return $this->model::with(['tags','urls','videos'])
            ->where('id',$id)
            ->first();
    }

    /**
     * @param array $data
     * @return Knowledge
     */
    public function update(array $data): Knowledge
    {
        $knowledge = $this->model::where('id',$data['id'])->first();
        if(isset($data['title'])) $knowledge->title = $data['title'];
        if(isset($data['description'])) $knowledge->description = $data['description'];
        if(isset($data['tag_id'])){
            $knowledge->tags()->attach([$data['tag_id']]);
        }
        $knowledge->save();

        return $knowledge;
    }

    /**
     * @param int $id
     * @return Knowledge
     */
    public function delete(int $id): Knowledge
    {
        $knowledge = $this->model::where('id',$id)->first();
        $knowledge->delete();
        return $knowledge;
    }

    public function all(int $id)
    {
        return $this->model::where('user_id',$id)->get();
    }
}
