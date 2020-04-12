<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SerialNumber extends Model
{
    protected $table = 'serial_number';

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


}
