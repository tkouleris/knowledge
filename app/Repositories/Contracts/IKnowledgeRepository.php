<?php


namespace App\Repositories\Contracts;


use App\Models\Knowledge;

interface IKnowledgeRepository
{
    public function create(array $data):Knowledge;
    public function update(array $data):Knowledge;
    public function findById(int $id);
    public function findByIdAndUserID(int $id, int $user_id);
    public function delete(int $id):Knowledge;
    public function findByTags(int $id, $searchTags = []);
}
