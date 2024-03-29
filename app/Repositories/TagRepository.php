<?php


namespace App\Repositories;


use App\Models\Tag;
use App\Repositories\Contracts\ITagRepository;
use DB;

class TagRepository implements ITagRepository
{
    /**
     * @var Tag
     */
    private $model;

    /**
     * TagRepository constructor.
     * @param $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }


    /**
     * @param array $data
     * @return Tag
     */
    public function create(array $data): Tag
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function delete(int $id): Tag
    {
        $tag = $this->model::where('id',$id)->first();
        if($tag)
        {
            $tag->delete();
        }
        return $tag;
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function findById(int $id): Tag
    {
        return $this->model::where('id',$id)->first();
    }

    public function findByName(string $tag_name)
    {
        return $this->model::whereRaw('LOWER(tag) = ?',[strtolower($tag_name)])->first();
    }

    public function update(array $data): Tag
    {
        $id = $data['id']??0;
        $tag_record = $this->model::where('id',$id)->first();

        if(isset($data['tag'])) $tag_record->tag = (string)$data['tag'];

        $tag_record->save();

        return $tag_record;
    }

    public function unrelateTagFromKnowledge(int $knowledge_id, int $tag_id):void
    {
        DB::table('knowledge_tag')->where('knowledge_id',$knowledge_id)
            ->where('tag_id',$tag_id)
            ->delete();
    }
}
