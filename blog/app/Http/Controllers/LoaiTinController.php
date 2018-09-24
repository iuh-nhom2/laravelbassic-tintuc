<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {           
            $loaitin = LoaiTin::all();
            // $theloai = TheLoai::paginate(5);
        //    paginate laravel use danhsach.blade.php
        //     <div class='row'>
        //       {{$theloai->links()}}
        //   </div>
            return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);

    }
    public function getThem()
    {   
        $theloai= TheLoai::all();

        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function getSua($id)
    {   
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view ('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
      
        $this->validate($request,[
            'txtTen' => 'required|unique:TheLoai,Ten|min:3|max:100',
            'opTheLoai'=>'required'
            
        ],
        [
            'txtTen.required' => 'Ban chua nhap ten loai tin',
            'txtTen.min' => 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTen.max'=> 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTen.unique'=>'Ten Loai Tin da ton tai'
        ]
       
        );
        $loaitin = LoaiTin::find($id);
        $loaitin-> Ten = $request->txtTen;
        $loaitin-> TenKhongDau = changeTitle($request->txtTen);
        $loaitin-> idTheLoai = $request->opTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/edit/'.$id)->with('thongbao','Sửa thành công');
    }
    public function postThem(Request $request){
        
        $this->validate($request,[
            'txtTenLoaiTin' => 'required|min:3|max:100',
            'opTheLoai'=> 'required'
        ],
        [
            'txtTenLoaiTin.required' => 'Ban chua nhap ten loai tin',
            'txtTenLoaiTin.min' => 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTenLoaiTin.max'=> 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTenLoaiTin.unique'=>'Ten The Loai da ton tai',

        ]
       
        );
        $loaitin = new LoaiTin;
        $loaitin-> idTheLoai = $request->opTheLoai;
        $loaitin-> Ten = $request->txtTenLoaiTin;
        
        $loaitin-> TenKhongDau = changeTitle($request->txtTenLoaiTin);
        
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }
  
    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        // $theloai ->delete();
        // return redirect('admin/theloai/danhsach')->with('thongbao','Da xoa thanh cong');
        // dd($theloai->loaitin);
        // exit;
        if(count($loaitin->tintuc)>0 )
            return redirect('admin/loaitin/danhsach')->with('thongbao','Khong the xoa du lieu');
         else{
                $loaitin ->delete();
                return redirect('admin/loaitin/danhsach')->with('thongbao','Da xoa thanh cong');
            }
          
       
    }
}
