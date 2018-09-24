@extends('admin.layout.index');

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh Sach
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
                                <th>Tieu De</th>
                                <th>Tom Tat</th>
                                <th>The Loai</th>
                                <th>Loai Tin</th>
                                <th>Xem</th>
                                <th>Noi Bat</th>
                               
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>
                                   <p> {{$tt->TieuDe}}</p> 
                                    <img width="100px" src="upload/tintuc/{{$tt->Hinh}}"/>

                                </td>
                                <td>{{$tt->TomTat}}</td>
                                <th>{{$tt->loaitin->theloai->Ten}}</th>
                                <th>{{$tt->loaitin->Ten}}</th>
                                <td>{{$tt->SoLuotXem}}</td>
                                <td>
                                    @if($tt->NoiBat == 0)
                                    {{'Khong noi Bat'}}

                                
                                    @else
                                        {{'Noi Bat'}}
                                    @endif

                                </td>
                               
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('editTintuc',$tt->id)}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection