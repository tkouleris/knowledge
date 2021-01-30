<?php


namespace App\Repositories\Contracts;


use App\Models\Knowledge;

interface IKnowledgeRepository
{
    public function create(array $data):Knowledge;

    public function findById(int $id):Knowledge;
}
