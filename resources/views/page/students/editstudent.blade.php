@extends('layout.index')
@section('title')
<title>Sửa học sinh</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Sửa thông tin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Xét hạnh kiểm</a>
                </li>
            </ul>
            @foreach($info as $value)
            <div class="tab-content">
              <div id="home" class="card-body tab-pane active">
                @if(count($errors)>0)
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $err)
                            {{$err}}<br>
                          @endforeach
                        </div>
                      @endif
                <h4 class="m-0 font-weight-bold text-primary">Học sinh lớp: {{$clas['name']}}. Kì học: {{$sem['start_year']."-".$sem['end_year']}}</h4>
                <hr>
                <form action="{{ route('edithocsinh', ['classid' => $clas['id'],'gradeid' =>$gradeid]) }}" method="POST">
                  {!!csrf_field() !!}
                  <input type="text" hidden class="form-control"  name="idstudent" value="{{$value['id']}}">
                  <div class="form-group">
                    <label >Họ:</label>
                    <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn ..." name="firstname" value="{{$value['first_name']}}">
                  </div>
                  <div class="form-group">
                    <label >Tên:</label>
                    <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn A" name="name" value="{{$value['name']}}">
                  </div>
                  <div class="form-group">
                    <label >Ngày sinh:</label>
                    <input type="date" class="form-control" name="birthday" value="{{$value['birthday']}}">
                  </div>
                  <div class="form-group">
                    <label >Giới tính:</label>
                    <select class="mdb-select md-form form-control" name="sex" >
                      <option value="{{$value['sex']}}" selected><?php if ($value['sex'] == "nam") {
                        $sexx = "nữ";
                        echo "nam";
                      } else {
                        $sexx = "nam";
                        echo "nữ";
                      }
                       ?></option>
                      <option value="{{$sexx}}">{{$sexx}}</option>
                    </select> 
                  </div>
                  <div class="form-group">
                    <label >Quê quán:</label>
                    <input type="text" class="form-control" placeholder="" name="birthplace" value="{{$value['birthplace']}}">
                  </div>                 
                  <button type="submit" class="btn btn-primary">Chấp nhận</button>
                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Xem mã hóa</button>
                <form>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Bản mã</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="">
                        {!!csrf_field() !!}
                        
                        <div class="form-group">
                          <label >Họ:</label>
                          <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn ..." name="" value="@if($value['first_name'] != null){{Illuminate\Support\Facades\Crypt::encryptString($value['first_name'])}}@else
                                  @endif">
                        </div>
                        <div class="form-group">
                          <label >Tên:</label>
                          <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn A" name="" value="@if($value['name'] != null){{Illuminate\Support\Facades\Crypt::encryptString($value['name'])}}@else
                                  @endif">
                        </div>
                        <div class="form-group">
                          <label >Ngày sinh:</label>
                          <input type="text" class="form-control" name="" value="@if($value['birthday'] != null){{Illuminate\Support\Facades\Crypt::encryptString($value['birthday'])}}@else
                                  @endif">
                        </div>
                        <div class="form-group">
                          <label >Giới tính:</label>
                          <input type="text" class="form-control" name="" value="@if($value['sex'] != null){{Illuminate\Support\Facades\Crypt::encryptString($value['sex'])}}@else
                                  @endif">
                        </div>
                        <div class="form-group">
                          <label >Quê quán:</label>
                          <input type="text" class="form-control" placeholder="" name="" value="@if($value['birthplace'] != null){{Illuminate\Support\Facades\Crypt::encryptString($value['birthplace'])}}@else
                                  @endif">
                        </div> 
                        <div class="form-group">
                          <label >Hạnh kiểm:</label>
                          <input type="text" class="form-control" placeholder="" name="" value="@if($value['status'] !== null){{Illuminate\Support\Facades\Crypt::encryptString($value['status'])}}@else
                                  @endif">
                        </div>                  
                      <form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại bản rõ</button>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div id="menu1" class="card-body tab-pane fade">
                <form action="{{ route('edithocsinh', ['classid' => $clas['id'],'gradeid' =>$gradeid]) }}" method="POST">
                  {!!csrf_field() !!}
                  <input type="text" hidden class="form-control"  name="idstudent" value="{{$value['id']}}">
                  <div class="form-group" style="display: table;">
                    <label >Xét hạnh kiểm của học sinh: {{$value['first_name']}} {{$value['name']}}:</label>
                    <select class="mdb-select md-form form-control" name="status" >
                      @if($value['status'] == 0 && $value['status'] !== null)
                      <option value="{{$value['status']}}" selected>Tốt</option>
                      @elseif($value['status'] == 1)
                      <option value="{{$value['status']}}" selected>Khá</option>
                      @elseif($value['status'] == 2)
                      <option value="{{$value['status']}}" selected>Trung bình</option>
                      @elseif($value['status'] == 3)
                      <option value="{{$value['status']}}" selected>Yếu</option>
                      @else
                      <option value="" selected>chưa có</option>
                      @endif
                      <option value="0">Tốt</option>
                      <option value="1">Khá</option>
                      <option value="2">Trung bình</option>
                      <option value="3">Yếu</option>
                    </select> 
                  </div>                 
                  <button type="submit" class="btn btn-primary">Chấp nhận</button>
                </form>
              </div>
            </div>
            @endforeach
          </div>
@endsection