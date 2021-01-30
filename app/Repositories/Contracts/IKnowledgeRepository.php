<?php


namespace App\Repositories\Contracts;


use App\Models\Knowledge;

interface IKnowledgeRepository
{
    public function create($data):Knowledge;

    public function findById($id):Knowledge;
}
