<?php


namespace App\Repositories\Contracts;


use App\Models\Tag;

interface ITagRepository
{
    public function findById(int $id):Tag;
    public function findByName(string $tag_name);
    public function create(array $data):Tag;
    public function delete(int $id):Tag;
    public function update(array $data): Tag;
}
