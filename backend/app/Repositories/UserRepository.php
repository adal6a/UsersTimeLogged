<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function usersLoggedTime(
        $date = '',
        $searchString = '',
        $orderByDate = 'asc',
        $orderByTime = 'asc'
    )
    {
        $limit = 10;

        return $this->model::usersLoggedTime()
            ->when($date, static function ($query) use ($date) {
                return $query->whereDate('loggedtime.last_active', $date);
            })
            ->when($searchString, static function ($query) use ($limit, $searchString) {
                return $query->where('name', 'LIKE', '%' . $searchString . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchString . '%')
                    ->limit($limit);
            })
            ->when($orderByDate, static function ($query) use ($orderByDate) {
                return $query->orderBy('logged_date', $orderByDate);
            })
            ->when($orderByTime, static function ($query) use ($orderByTime) {
                return $query->orderBy('total_logged_time', $orderByTime);
            })
            ->paginate($limit);
    }
}
