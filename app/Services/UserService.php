<?php


namespace App\Services;


use App\Exceptions\BadRequestException;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Hashing\HashManager;

class UserService
{
    private $userRepository;
    private $hashManager;


    /**
     * UserService constructor.
     * @param IUserRepository $userRepository
     * @param HashManager $hashManager
     */
    public function __construct(IUserRepository $userRepository, HashManager $hashManager)
    {
        $this->userRepository = $userRepository;
        $this->hashManager = $hashManager;
    }


    /**
     * @param $data
     * @return mixed
     * @throws BadRequestException
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function update($data)
    {
        if(!isset($data['id']) || (int)$data['id'] <= 0){
            throw new BadRequestException("User ID is not valid!");
        }
        $updated_data = [];
        if( isset($data['name']) && $data['name'] !== ''){
            $updated_data['name'] = $data['name'];
        }
        if( isset($data['password']) && $data['password'] !== ''){
            $updated_data['password'] = $this->hashManager->make($data['password']);
        }

        return $this->userRepository->update($data['id'],$updated_data);
    }
}
