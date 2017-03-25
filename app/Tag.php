<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    public $timestamps = false;

    public function articlesByTag(){
        return $this->belongsToMany(Article::class);
    }
}
