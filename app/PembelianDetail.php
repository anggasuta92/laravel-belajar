<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PembelianDetail extends Model
{
    protected $table = 'pembelian_detail';

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

    public function barang(){
        return $this->belongsTo('App\Barang');
    }

    public function serialNumber(){
        return $this->hasMany('App\SerialNumber');
    }

}
