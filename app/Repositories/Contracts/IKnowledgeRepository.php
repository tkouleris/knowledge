<?php


namespace App\Repositories\Contracts;


use App\Exceptions\KnowledgeNotFoundException;
use App\Models\Knowledge;

interface IKnowledgeRepository
{
    public function create(array $data):Knowledge;
    public function update(array $data):Knowledge;
    public function findById(int $id);
    public function findByIdAndUserID(int $id, int $user_id);

    /**
     * @param int $id
     * @return Knowledge
     * @throws KnowledgeNotFoundException
     */
    public function delete(int $id):Knowledge;

    public function findByTags(int $id, $searchTags = []);
}
