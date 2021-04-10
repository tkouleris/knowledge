<?php


namespace App\Repositories\Contracts;


use App\Exceptions\UserNotFoundException;
use App\Models\User;

interface IUserRepository
{
    public function findByEmail(string $email):User;

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws UserNotFoundException
     */
    public function update(int $id, array $data);
}
