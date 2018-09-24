<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
class PageController extends Controller
{
    //
       
        function trangchu(){
            $theloai = TheLoai::all();
            $slide = Slide::all();
            
           
            return view('page.trangchu',['theloai'=>$theloai,'slide'=>$slide]);
        }
        function lienhe(){
            $slide = Slide::all();
            $theloai = TheLoai::all();
            return view('page.lienhe',['theloai'=>$theloai,'slide'=>$slide]);
        }
        function loaitin($id){
            $theloai = TheLoai::all();
            $loaitin = LoaiTin::find($id);
            $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5); //paginate phan trang
            return view('page.loaitin',['theloai'=>$theloai,'loaitin'=>$loaitin,'tintuc'=>$tintuc]);
        }
        function tintuc($id){
            $theloai = TheLoai::all();
            $tintuc = TinTuc::find($id);
            $tintucnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
            $tintuclienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
            
           return view('page.detailtintuc',['tintuc'=>$tintuc,'tintucnoibat'=>$tintucnoibat,'tintuclienquan'=>$tintuclienquan]);
        }
        

}
