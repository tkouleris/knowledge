<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Contracts\IUserRepository;

class UserRepository implements IUserRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * UserRepository constructor.
     * @param $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    public function findByEmail(string $email): User
    {
        return $this->model::where('email', $email)->first();
    }
}
