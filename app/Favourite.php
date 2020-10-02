<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_id'];
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
