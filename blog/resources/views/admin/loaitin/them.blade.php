  @extends('admin.layout.index')

  @section('content');
  <!-- Page Content -->
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loai Tin
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
                        <form action="admin/loaitin/them" method="POST">
                         <input type="hidden" name="_token" value="{{
                                csrf_token()}}"/>
                            <div class="form-group">
                                <label>Category Parent</label>
                                <select class="form-control" name="opTheLoai">
                                    
                                    @foreach($theloai as $tl)
                                        <option value ="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="txtTenLoaiTin" placeholder="Vui Long Nhap Ten Loai Tin" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Category Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
  
@endsection