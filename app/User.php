<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Setmenu;
use App\Order;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status','role',
    ];
    public function getRules(){
        return [
            'name' => 'required|string',
            'email' => 'required|email'
        ];
    }

    public function setmenu()
    {
        return $this->hasMany('App\Setmenu','added_by','id');
    }

    public function order()
    {
        return $this->hasMany('App\Order','ordered_by','id');
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
