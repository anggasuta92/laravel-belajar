<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Relasi extends Model
{
    protected $table = 'relasi';

    protected $guarded = []; // YOLO

    protected static function boot(){
        parent::boot();
        static::creating(function ($post){
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing(){
        return false;
    }

    public function getKeyType(){
        return 'string';
    }

}
