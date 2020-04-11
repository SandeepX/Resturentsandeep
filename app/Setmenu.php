<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Menu;
use App\User;
class Setmenu extends Model
{
    protected $fillable = ['created_date','menu','added_by'];

    public function getRules(){
    	return [
    		'date' => 'required'
    		// 'menu' => 'required|string'
    	];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function menu()
    {
    	return $this->belongsTo(Menu::class);
    }

}
