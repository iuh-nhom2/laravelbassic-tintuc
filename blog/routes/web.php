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
use App\LoaiTin;
Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/login','UserController@getdangnhapAdmin');
Route::post('admin/login','UserController@postdangnhapAdmin');
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

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
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
        // add/theloai/edit/{id}
        Route::get('edit/{id}','LoaiTinController@getSua');
        Route::post('edit/{id}','LoaiTinController@postSua');

        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');

        Route::get('xoa/{id}',
        ['as'=>'xoaloaitin',
        'uses'=> 'LoaiTinController@getXoa'
        ]);
    });
    Route::group(['prefix'=>'tintuc'],function(){
            Route::get('danhsach','TinTucController@getDanhSach');
            // add/theloai/edit/{id}
            Route::get('edit/{id}','TinTucController@getSua')->name('editTintuc');
            Route::post('edit/{id}','TinTucController@postSua')->name('updateTintuc');

            Route::get('them','TinTucController@getThem');
            Route::post('them','TinTucController@postThem');

            // Route::get('xoa/{id}',
            // ['as'=>'xoatintuc',
            // 'uses'=> 'TinTucController@getXoa'
            // ]);
            Route::get('xoa/{id}','TinTucController@getXoa');

        
        });
        Route::group(['prefix'=>'comment'],function(){
           
            Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');

        
        });
        Route::group(['prefix'=>'slide'],function(){
            Route::get('danhsach','SlideController@getDanhSach');
            // add/theloai/edit/{id}
            Route::get('edit/{id}','SlideController@getSua');
            Route::post('edit/{id}','SlideController@postSua');

            Route::get('them','SlideController@getThem');
            Route::post('them','SlideController@postThem');

            // Route::get('xoa/{id}',
            // ['as'=>'xoatintuc',
            // 'uses'=> 'TinTucController@getXoa'
            // ]);
            Route::get('xoa/{id}','SlideController@getXoa');

        
        });
        Route::group(['prefix'=>'comment'],function(){
           
            Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');

        
        });
    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','UserController@getDanhSach');
            // add/theloai/edit/{id}
            Route::get('edit/{id}','UserController@getSua');
            Route::post('edit/{id}','UserController@postSua');

            Route::get('them','UserController@getThem');
            Route::post('them','UserController@postThem');

            Route::get('xoa/{id}',
            ['as'=>'xoatheloai',
            'uses'=> 'TheLoaiController@getXoa'
            ]);
            Route::get('adminlogout','UserController@getLogOut');
    });
  

    Route::group(['prefix'=>'ajax'],function(){
        // Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
        Route::get('loaitin/{idLoaiTin}','AjaxController@getLoaiTin');
    });
});

Route::get('trangchu','PageController@trangchu');

Route::get('lienhe','PageController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PageController@tintuc');
Route::get('dangnhap','PageController@getdangnhap');
Route::post('dangnhap','PageController@postdangnhap');

