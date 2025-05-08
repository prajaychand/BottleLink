<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['image','title','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
