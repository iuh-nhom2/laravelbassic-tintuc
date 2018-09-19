<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});

Route::get('thu',function(){
    $theloai = TheLoai::find(1); // lay theo id =1
    foreach($theloai->loaitin as $loaitin){
        echo $loaitin->Ten."<br>";
    }

});
//test giao diện
Route::get('test', function(){
    return view('admin.theloai.danhsach');
});

Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'theloai'],function(){
            Route::get('danhsach','TheLoaiController@getDanhSach');
            // add/theloai/edit/{id}
            Route::get('edit/{id}','TheLoaiController@getSua');
            Route::post('edit/{id}','TheLoaiController@postSua');

            Route::get('them','TheLoaiController@getThem');
            Route::post('them','TheLoaiController@postThem');

            Route::get('xoa/{id}',
            ['as'=>'xoatheloai',
            'uses'=> 'TheLoaiController@getXoa'
            ]);
    });
    Route::group(['prefix'=>'loaitin'],function(){
        Route::get('danhsach','LoaiTinController@getDanhSach');

        Route::get('edit','LoaiTinController@getSua');

        Route::get('them','LoaiTinController@getThem');
    });
    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('danhsach','TinTucController@getDanhSach');

        Route::get('edit','TinTucController@getSua');

        Route::get('them','TinTucController@getThem');
    });
    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','UserController@getDanhSach');

        Route::get('edit','UserController@getSua');

        Route::get('them','UserController@getThem');
    });
});


