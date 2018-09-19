<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "TheLoai";
    public function loaitin(){
        // hasmany 1->nhieu
        return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
    // public function tintuc(){
    //     return $this->hasmany('App\TinTuc','App\LoaiTin', 'idTheLoai','idLoaiTin', 'id');
    // }
}
