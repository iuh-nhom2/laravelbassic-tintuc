<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;
class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        // $tintuc= TinTuc::all();
        return view ('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getSua($id){
            $tintuc = TinTuc::find($id);
            $theloai = TheLoai::all();
             $loaitin = LoaiTin::all();
          
            return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postSua(Request $request,$id){

        // dd($request);
        // exit;
        $tintuc =TinTuc::find($id);
        $this->validate($request,[
            'onTheLoai'=>'required',
            'onLoaiTin'=>'required',
            'txtTieuDe'=>'min:3',
            'txtTomtat'=>'required|min:3',
            'txtNoiDung'=>'required'
        ],[
            'onTheLoai.required'=>'Chua chon the loai',
            'onLoaiTin.required'=>'ban chua nhap loai tin',
            'txtTieuDe.min'=>'Tieu de phai tu 3 ky tu tro len',
           
            'txtTomtat.required'=>'Chua nhap tom tat',
            'txtTomtat.min'=>'Tom tat: phai tu 3 ky tu tro len ',
            'txtNoiDung.required'=>'Ban chua nhap noi dung'

        ]);
        
        
        
        // $tintuc-> TieuDe =$request->txtTieuDe;
        $tintuc->TieuDeKhongDau =changeTitle($request->txtTieuDe);
        $tintuc->idLoaiTin = $request->onLoaiTin;
        $tintuc->TomTat = $request->txtTomtat;
        $tintuc->NoiDung = $request->txtNoiDung;
        $tintuc->NoiBat = $request->rdoNoiBat;
        
        
        $tintuc-> TieuDe =$request->txtTieuDe;
        // $tintuc-> TieuDeKhongDau ="asdasdasdasd";
        // $tintuc-> idLoaiTin = 1;
        // $tintuc-> TomTat = "asdasdasdasd";
        // $tintuc-> NoiDung = "asdasdasdasd";
        // $tintuc-> NoiBat = 1;
        // $tintuc-> SoLuotXem =0;
        
        if($request->hasfile('Hinh')){
            $file = $request->file('Hinh');
            
            $duoihinh= $file->getClientOriginalExtension();
            if($duoihinh != 'jpg' && $duoihinh != 'png' && $duoihinh !='jpeg'){
                return redirect('admin/tintuc/edit/'.$id)->with('Error','File khong phu hop, file dc chap nhan bao gom (jpg, png, peg)');
            }
           
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }                       
            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        
        
        }
        
        $tintuc->save();
        return redirect('admin/tintuc/edit/'.$id)->with('thongbao','Sua thanh cong');
    }
    public function getThem(){
        
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){
        $this->validate($request,[
            'onTheLoai'=>'required',
            'onLoaiTin'=>'required',
            'txtTieuDe'=>'required|min:3|unique:Tintuc,TieuDe',
            'txtTomtat'=>'required|min:3',
            'txtNoiDung'=>'required'
        ],[
            'onTheLoai.required'=>'Chua chon the loai',
            'onLoaiTin.required'=>'ban chua nhap loai tin',
            'txtTieuDe.min'=>'Tieu de phai tu 3 ky tu tro len',
            'txtTieuDe.unique'=>'Tieu de da ton tai',
            'txtTomtat.required'=>'Chua nhap tom tat',
            'txtTomtat.min'=>'Tom tat: phai tu 3 ky tu tro len ',
            'txtNoiDung.required'=>'Ban chua nhap noi dung'
        ]);

        $tintuc = New TinTuc;
        
        // $tintuc-> TieuDe =$request->txtTieuDe;
        $tintuc-> TieuDeKhongDau =changeTitle($request->txtTieuDe);
        $tintuc-> idLoaiTin = $request->onLoaiTin;
        $tintuc-> TomTat = $request->txtTomtat;
        $tintuc-> NoiDung = $request->txtNoiDung;
        $tintuc-> NoiBat = $request->rdoNoiBat;
        $tintuc-> SoLuotXem=0;

        $tintuc-> TieuDe =$request->txtTieuDe;
        // $tintuc-> TieuDeKhongDau ="asdasdasdasd";
        // $tintuc-> idLoaiTin = 1;
        // $tintuc-> TomTat = "asdasdasdasd";
        // $tintuc-> NoiDung = "asdasdasdasd";
        // $tintuc-> NoiBat = 1;
        // $tintuc-> SoLuotXem =0;
        
        if($request->hasfile('Hinh')){
            $file = $request->file('Hinh');
            
            $duoihinh= $file->getClientOriginalExtension();
            if($duoihinh != 'jpg' && $duoihinh != 'png' && $duoihinh !='jpeg'){
                return redirect('admin/tintuc/them')->with('Error','File khong phu hop, file dc chap nhan bao gom (jpg, png, peg)');
            }
           
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                $Hinh = str_random(4)."_".$name;
            }                       
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        
        
        }
        else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Them tin thanh cong');
        
    }
    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao','Xoa thanh cong');
    }
}
