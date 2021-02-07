<?php


namespace App\Services;


use App\Models\Knowledge;
use App\Repositories\Contracts\IKnowledgeRepository;

class KnowledgeService
{
    private $knowledgeRepository;

    /**
     * KnowledgeService constructor.
     * @param $knowledgeRepository
     */
    public function __construct(IKnowledgeRepository $knowledgeRepository)
    {
        $this->knowledgeRepository = $knowledgeRepository;
    }

    /**
     * @return Knowledge
     */
    public function createDefaultRecord(): Knowledge
    {
        $data['title'] = "Untitled knowledge";
        $data['description'] = "No description";
        return $this->knowledgeRepository->create($data);
    }

    /**
     * @param int $id
     * @return Knowledge
     */
    public function show(int $id): Knowledge
    {
        return $this->knowledgeRepository->findById($id);
    }

    /**
     * @param int $id
     * @return Knowledge
     */
    public function delete(int $id): Knowledge
    {
        return $this->knowledgeRepository->delete($id);
    }

    /**
     * @param array $data
     * @return Knowledge
     */
    public function update(array $data): Knowledge
    {
        return $this->knowledgeRepository->update($data);
    }


}
