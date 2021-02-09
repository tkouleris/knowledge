<?php


namespace App\Repositories\Contracts;


use App\Models\Url;

interface IUrlRepository
{
    public function create(array $data):Url;
}
