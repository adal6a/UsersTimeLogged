<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /* Scopes */
    /**
     * @var $baseTime
     *
     * timediff need two ranges but with difference values,
     * owever, what about the ranges are same (only one record for last_active for example)?
     * for that case, set a base time as min time
     */
    public function scopeUsersLoggedTime($query, $baseTime = '00:00:00')
    {
        return $query->select(
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.mobile as mobile',
            DB::raw("date(loggedtime.last_active) as logged_date") ,
            DB::raw("timediff(max(time(last_active)), IF(count(last_active) = 1, time ('{$baseTime}'), min(time(last_active)))) as total_logged_time"))
            ->join('loggedtime_users as loggedtime', 'loggedtime.user_id', '=', 'users.id')
            ->groupBy(
                'id',
                'name',
                'email',
                'mobile',
                'logged_date'
            );
    }
}
