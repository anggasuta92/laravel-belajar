<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Barang extends Model
{
    protected $table = 'barang';

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

    public function kategori(){
        return $this->belongsTo('App\Kategori');
    }

}
