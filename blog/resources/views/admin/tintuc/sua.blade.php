@extends('admin.layout.index')

@section('content')

 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tuc
                            <small>{{$tintuc->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                            <div class="alert  alert-danger">
                                    @foreach($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                             </div>
                             @else
                             <div class="alert alert-success">
                                {{session('Error')}}
                             </div>
                        @endif
                        <form action="admin/tintuc/edit/{{$tintuc->id}}" method="POST"  enctype="multipart/form-data"
                            >
                            <!-- {{route('updateTintuc',$tintuc->id)}} -->
                           
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>The Loai</label>
                                <select class="form-control" name="onTheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                        <option    
                                            @if($tintuc->loaitin->theloai->id == $tl->id)
                                                {{"selected"}}
                                            @endif
                                                value="{{$tl->id}}">
                                                {{$tl -> Ten}}
                                        </option>
                                        

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loai Tin</label>
                                <select class="form-control" name="onLoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $lt)

                                         <option    
                                            @if($tintuc->loaitin->id == $lt->id)
                                                {{"selected"}}
                                            @endif
                                                value="{{$lt->id}}">
                                                {{$lt -> Ten}}
                                        </option>
                                        

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tieu De:</label>
                                <input class="form-control" name="txtTieuDe" value="{{$tintuc->TieuDe}}" placeholder="Please Enter Category Name" />
                            </div>
                           
                            <div class="form-group">
                                <label>Tom Tat</label>
                                <textarea name="txtTomtat" id="demo" class="form-control ckeditor" rows="3">
                                            {{$tintuc->TomTat}}

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Noi Dung</label>
                                <textarea name="txtNoiDung" id="demo" class="form-control ckeditor" rows="8">
                                         {{$tintuc->NoiDung}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Hinh:</label>
                                <img src="upload/tintuc/{{$tintuc->Hinh}}" width="300px" /><br>
                                <input type="file" name="Hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="rdoNoiBat" value="1"
                                            @if($tintuc->NoiBat == 1)
                                                {{"checked"}}
                                            @endif
                                    checked="" type="radio">Co
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoNoiBat" value="0"
                                        @if($tintuc->NoiBat == 0)
                                                {{"checked"}}
                                            @endif
                                    type="radio">Khong
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">News Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh Sach Comment
                            <small>Tin Tuc</small>
                        </h1>
                    </div>

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                                {{session('thongbao')}}
                        </div>
                       
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>User</th>
                                <th>Noi Dung</th>
                                <th>Ngay comment:</th>
                               
                               
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as  $cmt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cmt->id}}</td>
                                <td>
                                   <p> {{$cmt->user->name}}</p> 
                                    
                                

                                </td>
                                <td>{{$cmt->NoiDung}}</td>
                                <th>{{$cmt->created_at}}</th>
                               
                                
                               
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cmt->id}}/{{$tintuc->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section('script')

        <script>
            $(document).ready(function(){
                $("#TheLoai").change(function(){
                    var idTheLoai = $(this).val();
                    // alert(idTheLoai);
                    $.get("admin/ajax/loaitin/"+idTheLoai, function(data){
                            // alert(data);
                            $("#LoaiTin").html(data);
                    })
                } );
            });
        </script>

@endsection