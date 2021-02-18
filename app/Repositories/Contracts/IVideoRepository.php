<?php


namespace App\Repositories\Contracts;


use App\Models\Video;

interface IVideoRepository
{
    public function create(array $data):Video;
    public function delete(int $id):Video;
    public function findById(int $id):Video;
    public function update(array $data):Video;
}
