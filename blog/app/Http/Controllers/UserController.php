<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\TheLoai;
class UserController extends Controller
{
    //

    public function getdangnhapAdmin(){

        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
            $this->validate($request,[
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],
            [
                'email.required'=>"Ban chua nhap email",
                'password.required'=>"ban chua  nhap pass word",
                'password.min'=>"password phai tren 3 ky tu",
                'passoword.max'=>"password khong duoc lon hon 32 ky tu"
            ]);
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect('admin/theloai/danhsach');

            }
            else{
                return redirect('admin/login')->with('thongbao','Dang nhap that bai');
            }
          
    }
    public function  getLogOut(){
        Auth::logout();
        return redirect('admin/login');
    }

    //
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
    public function login(Request $request){
        $credentials = $request->only('\'email\'',' \'password\'');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['\'invalid_email_or_password\''], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['\'failed_to_create_token\''], 500);
        }
        return response()->json(compact('\'token\''));
    }
}
