<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {           
            $theloai = TheLoai::all();
            // $theloai = TheLoai::paginate(5);
        //    paginate laravel use danhsach.blade.php
        //     <div class='row'>
        //       {{$theloai->links()}}
        //   </div>
            return view('admin.theloai.danhsach',['theloai'=>$theloai]);

    }
    public function getThem()
    {
        return view('admin.theloai.them');
    }
    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view ('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,[
            'txtTen' => 'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'txtTen.required' => 'Ban chua nhap ten the loai',
            'txtTen.min' => 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTen.max'=> 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTen.unique'=>'Ten The Loai da ton tai'
        ]
       
        );
        
        $theloai-> Ten = $request->txtTen;
        $theloai-> TenKhongDau = changeTitle($request->txtTen);
        
        $theloai->save();
        return redirect('admin/theloai/edit/'.$id)->with('thongbao','Sửa thành công');
    }
    public function postThem(Request $request){
        // echo $request->txtTenTheLoai;
        $this->validate($request,[
            'txtTenTheLoai' => 'required|min:3|max:100'
        ],
        [
            'txtTenTheLoai.required' => 'Ban chua nhap ten the loai',
            'txtTenTheLoai.min' => 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTenTheLoai.max'=> 'Ten do dai phai tu 3 den 100 ki tu',
            'txtTenTheLoai.unique'=>'Ten The Loai da ton tai'
        ]
       
        );
        $theloai = new TheLoai;
        $theloai-> Ten = $request->txtTenTheLoai;
        $theloai-> TenKhongDau = changeTitle($request->txtTenTheLoai);
        
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }
  
    public function getXoa($id){
        $theloai = TheLoai::find($id);
        // $theloai ->delete();
        // return redirect('admin/theloai/danhsach')->with('thongbao','Da xoa thanh cong');
        // dd($theloai->loaitin);
        // exit;
        if(count($theloai->loaitin)>0 )
            return redirect('admin/theloai/danhsach')->with('thongbao','Khong the xoa du lieu');
            else{
                $theloai ->delete();
                return redirect('admin/theloai/danhsach')->with('thongbao','Da xoa thanh cong');
            }
          
       
    }
}
