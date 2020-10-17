@extends('layout.index')
@section('title')
<title>Thiết lập Admin</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Sửa thông tin</a>
                </li>
            </ul>
            <div class="tab-content">
              <div id="home" class="card-body tab-pane active">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              @if(session('thongbao'))
              <div class="alert alert-danger">
                  {{session('thongbao')}}
              </div>
              @endif
              <form action="{{$users['id']}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Tài khoản: {{$users['account']}}</label>
                </div>
                <div class="form-group">
                  <label >Tên:</label>
                  <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn A" name="name" value="{{$users['name']}}">
                </div>
                <div class="form-group">
                  <label >Ngày sinh:</label>
                  <input type="date" class="form-control" name="birthday" value="{{$users['birthday']}}">
                </div>
                <div class="form-group">
                  <label >Môn giảng dạy:</label>
                  <select class="mdb-select md-form form-control" name="subjectid" >
                    <option value="{{$users['subject_id']}}" disabled selected><?php $subj = App\Subject::find($users['subject_id']); if ($subj == null || $users['subject_id'] == -1) {
                      echo "không có";
                    }else{ echo $subj['name']; } ?></option>
                    <option value="-1">Không có</option>
                    @foreach($subject as $sj)
                    <option value="{{$sj['id']}}">{{$sj['name']}}</option>
                    @endforeach
                  </select> 
                </div>             
                <button type="submit" class="btn btn-primary">Chấp nhận</button><a href="{{route('changepwadmin',['id' => $users['id']])}}">         Đổi mật khẩu</a>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Xem mã hóa tài khoản</button>

              </form>
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
                    <form>
                      {!!csrf_field() !!}
                      <div class="form-group">
                        <label >Tài khoản:</label>
                        <input type="text" class="form-control" name="" value="{{$users['account']}}">
                      </div>
                      <div class="form-group">
                        <label >Mật khẩu:</label>

                        <input type="text" class="form-control"  name="" value="{{$users['password']}}">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại</button>
                  </div>
                </div>
                
              </div>
            </div>
            </div>
            </div>
          </div>
@endsection