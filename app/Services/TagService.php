<?php


namespace App\Services;


use App\Models\Tag;
use App\Models\User;
use App\Repositories\Contracts\ITagRepository;

class TagService
{
    /**
     * @var ITagRepository
     */
    private $tagRepository;

    /**
     * TagService constructor.
     * @param $tagRepository
     */
    public function __construct(ITagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param array $data
     * @param User $user
     * @return Tag
     */
    public function create(array $data, User $user): Tag
    {
        $data['tag'] = 'Untitled tag';
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

    public function update(array $data)
    {
        return $this->tagRepository->update($data);;
    }


}
