<?php


namespace App\Repositories\Contracts;


use App\Models\Tag;

interface ITagRepository
{
    public function findById(int $id):Tag;
    public function create(array $data):Tag;
    public function delete(int $id):Tag;
    public function update(array $data): Tag;
}
