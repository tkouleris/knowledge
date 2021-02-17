<?php


namespace App\Repositories\Contracts;


use App\Models\Video;

interface IVideoRepository
{
    public function create(array $data):Video;
}
