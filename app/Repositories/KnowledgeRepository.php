<?php


namespace App\Repositories;


use App\Exceptions\KnowledgeNotFoundException;
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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findById(int $id)
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
     * @throws KnowledgeNotFoundException
     */
    public function delete(int $id): Knowledge
    {
        $knowledge = $this->model::where('id',$id)->first();
        if($knowledge === null){
            throw new KnowledgeNotFoundException("Knowledge not found");
        }
        $knowledge->delete();
        return $knowledge;
    }

    public function findByTags(int $id, $searchTags = [])
    {
         $knowledge = $this->model::with('tags')->where('user_id',$id);
         if(count($searchTags) > 0){
             $knowledge->whereHas('tags', function($q) use($searchTags){
                 $q->whereRaw("LOWER(tag) in (".implode(",",$searchTags).")");
             });
         }
        return $knowledge->get();
    }

    public function findByIdAndUserID(int $id, int $user_id)
    {
        return $this->model::with(['tags','urls','videos'])
            ->where('id',$id)
            ->where('user_id',$user_id)
            ->first();
    }
}
