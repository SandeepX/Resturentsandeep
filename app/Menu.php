<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Setmenu;
use App\Order;
class Menu extends Model
{
    protected $fillable = ['name','price'];

    public function getRules(){
    	return [
    		'name' => 'required|string',
    		'price' => 'required|numeric'
    	];
    }

	

    public function setmenu()
    {
        return $this->hasMany('App\Setmenu','menu','id');
    }


    public function order()
    {
        return $this->hasMany('App\Order','item','id');
    }
 }
