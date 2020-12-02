<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['ctegory_id', 'name', 'price', 'desc', 'image'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
