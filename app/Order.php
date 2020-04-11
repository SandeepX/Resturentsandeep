<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Menu;
class Order extends Model
{
    protected $fillable = [
        'ordered_date', 'item', 'qty','rate','cost','ordered_by'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
