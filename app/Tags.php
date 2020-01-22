<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name'];

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
