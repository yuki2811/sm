@extends('layout.index')
@section('title')
<title>Thêm người dùng</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Thêm mới người dùng</h3>
            </div>
            <div class="card-body">
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
              <form action="{{url('admin/users/themnguoidung')}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Tên:</label>
                  <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn A" name="name" >
                </div>
                <div class="form-group">
                  <label >Ngày sinh:</label>
                  <input type="date" class="form-control" name="birthday">
                </div>
                <div class="form-group">
                  <label >Tên đăngn nhập:</label>
                  <input type="text" class="form-control"  name="account" >
                </div>
                <div class="form-group">
                  <label >Mật khẩu:</label>
                  <input type="password" class="form-control"  name="password" >
                </div>
                <div class="form-group">
                  <label >Nhập lại mật khẩu:</label>
                  <input type="password" class="form-control"  name="repassword" >
                </div>
                <div class="form-group">
                  <label >Môn giảng dạy:</label>
                  <select class="mdb-select md-form form-control" name="subjectid" >
                    <option value="" disabled selected>chọn môn giảng dạy:</option>
                    <option value="-1">Không có</option>
                    @foreach($subject as $sj)
                    <option value="{{$sj['id']}}">{{$sj['name']}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="form-group">
                  <label >Quyền:</label>
                  <select class="mdb-select md-form form-control" name="superadmin" >
                    <option value="" disabled selected>chọn quyền:</option>
                    <option value="1">Quản trị viên</option>
                    <option value="2">Giáo viên</option>
                  </select> 
                </div>                     
                <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
          </div>
@endsection