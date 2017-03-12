<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    public function scopeLatestArticles($builder){
        return $builder->orderBy('created','desc')->get();
    }
}
