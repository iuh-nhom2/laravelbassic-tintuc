<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = "LoaiTin";
    public function theloai(){
        // loia tin thuoc65 mot65 the63 loai nao2 d9o1 nen6 khai bao1 belongsTo
        return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }
    public function TinTuc(){
        return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
