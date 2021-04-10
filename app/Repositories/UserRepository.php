<?php


namespace App\Repositories;


use App\Exceptions\UserNotFoundException;
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


    /**
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws UserNotFoundException
     */
    public function update(int $id, array $data)
    {
        $user = $this->model::where('id',$id)->first();
        if($user === null){
            throw new UserNotFoundException("User not found!");
        }
        if( isset($data['name']) && $data['name'] !== ''){
            $user->name = $data['name'];
        }
        if( isset($data['password']) && $data['password'] !== ''){
            $user->password = $data['password'];
        }
        $user->save();

        return $this->model::where('id',$id)->first();
    }
}
