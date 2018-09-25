<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
class PageController extends Controller
{
    //  
        public function theloai(){
            return TheLoai::all();
        }
        function _contruct(){
            if(Auth::check()){
                view()->share('nguoidung',Auth::user());
            }
        }
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
        function getdangnhap(){
           
            return view('page.dangnhap');
        }
        function postdangnhap(Request $request){
                // echo $request->email."<br>";
                // echo $request->password;
               
                $this->validate($request,[
                    'email'=>'required',
                    'password'=>'required|min:3|max:32|'
                ],[
                    'email.required'=>"Ban chua nhap email",
                    'password.required'=>"ban chua nhap password",
                    'password.min'=>"password phai nhieu hon 3 ky tu",
                    'password.max'=>"password  phai lon 3 ky tu"
                ]);
       

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {   
            
            return redirect('trangchu');
        }
        else{
            return redirect('dangnhap')->with('thongbao','Login Failed: wrong id or password ');
        }
    }
}
