<?php


namespace App\Repositories\Contracts;


use App\Models\Url;

interface IUrlRepository
{
    public function create(array $data):Url;
    public function findById(int $id):Url;
    public function delete(int $id):Url;
    public function update(array $data):Url;
}
