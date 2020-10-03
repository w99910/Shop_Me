<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function sender(){
        return $this->belongsTo('App\User','from','id');
    }
    public function getTimeAttribute(){
        return $this->created_at->diffForHumans();
    }

}
