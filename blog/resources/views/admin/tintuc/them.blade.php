  @extends('admin.layout.index')

  @section('content');
  <!-- Page Content -->
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tuc
                            <small>Add</small>
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
                        @endif
                        <form action="admin/tintuc/them" method="POST"  enctype="multipart/form-data"
                            >

                           
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>The Loai</label>
                                <select class="form-control" name="onTheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)

                                        <option value="{{$tl->id}}">{{$tl->Ten}} </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loai Tin</label>
                                <select class="form-control" name="onLoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $lt)

                                        <option value="{{$lt->id}}">{{$lt->Ten}} </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tieu De:</label>
                                <input class="form-control" name="txtTieuDe" placeholder="Please Enter Category Name" />
                            </div>
                           
                            <div class="form-group">
                                <label>Tom Tat</label>
                                <textarea name="txtTomtat" id="demo" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Noi Dung</label>
                                <textarea name="txtNoiDung" id="demo" class="form-control ckeditor" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hinh:</label>
                                <input type="file" name="Hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="rdoNoiBat" value="1" checked="" type="radio">Co
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoNoiBat" value="2" type="radio">Khong
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">News Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
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
