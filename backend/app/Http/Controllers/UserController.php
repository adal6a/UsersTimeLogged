<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ResponseAPI;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function users_logged_time(Request $request): JsonResponse
    {
        $date = $request->input('date');
        $searchString = str_replace(' ', '', $request->input('searchString'));
        $orderByDate = $request->input('orderByDate');
        $orderByTime = $request->input('orderByTime');

        return $this->success(
            'Users has been loaded correctly',
            $this->userRepository->usersLoggedTime(
                $date,
                $searchString,
                $orderByDate,
                $orderByTime
            )
        );
    }
}
