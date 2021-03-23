<?php


namespace App\Services;


use App\Models\Knowledge;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\ITagRepository;
use DB;

class TagService
{
    /**
     * @var ITagRepository
     */
    private $tagRepository;

    /**
     * @var KnowledgeService
     */
    private $knowledgeService;

    /**
     * TagService constructor.
     * @param ITagRepository $tagRepository
     * @param KnowledgeService $knowledgeService
     */
    public function __construct(ITagRepository $tagRepository, KnowledgeService $knowledgeService)
    {
        $this->tagRepository = $tagRepository;
        $this->knowledgeService = $knowledgeService;
    }

    /**
     * @param array $data
     * @param User $user
     * @return Tag
     */
    public function create(array $data, User $user): Tag
    {
        $data['tag'] = (isset($data['tag']) && (string)$data['tag'] !== '')?$data['tag']:'Untitled tag';
        $data['user_id'] = $user->id;
        return $this->tagRepository->create($data);
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function delete(int $id): Tag
    {
        return $this->tagRepository->delete($id);
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function findById(int $id): Tag
    {
        return $this->tagRepository->findById($id);
    }

    /**
     * @param array $data
     * @return Tag
     */
    public function update(array $data): Tag
    {
        return $this->tagRepository->update($data);
    }

    /**
     * @param Knowledge $knowledge
     * @param User $user
     * @param string $tag
     * @return Knowledge
     */
    public function tagKnowledge(Knowledge $knowledge, User $user, string $tag): Knowledge
    {
        $currentTag = $this->tagRepository->findByName($tag);
        if($currentTag === null)
        {
            $currentTag = $this->create(['tag'=>$tag],$user);
        }

        $relation = DB::table('knowledge_tag')->select('id')
            ->where('knowledge_id',$knowledge->id)
            ->where('tag_id',$currentTag->id)
            ->first();

        if(!$relation){
            DB::table('knowledge_tag')->insert([
                'knowledge_id' => $knowledge->id,
                'tag_id' => $currentTag->id
            ]);
        }

        return $this->knowledgeService->show($knowledge->id);
    }

    /**
     * @param $id
     * @param $tag_id
     */
    public function unrelateTagFromKnowledge($id, $tag_id): void
    {
        DB::table('knowledge_tag')->where('knowledge_id',$id)
            ->where('tag_id',$tag_id)
            ->delete();
    }
}
