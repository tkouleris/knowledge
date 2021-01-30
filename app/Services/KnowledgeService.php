<?php


namespace App\Services;


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

    public function createDefaultRecord()
    {
        $data['title'] = "Untitled knowledge";
        $data['description'] = "No description";
        return $this->knowledgeRepository->create($data);
    }


}
