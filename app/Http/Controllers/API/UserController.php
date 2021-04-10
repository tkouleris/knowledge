<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Hashing\HashManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponse;

    private $userService;

    /**
     * UserController constructor.
     * @param $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * @param Request $request
     * @param HashManager $hashManager
     * @return Response
     * @throws \App\Exceptions\BadRequestException
     * @throws \App\Exceptions\UserNotFoundException
     */
    public function update(Request $request, HashManager $hashManager): Response
    {
        $data = $request->input();
        $user = $this->userService->update($data);
        return new Response($this->success($user,"updated"),200);
    }
}
