<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = true;

    public function scopeLatestArticles($builder){
        return $builder->orderBy('created_at','desc')->paginate(10);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
