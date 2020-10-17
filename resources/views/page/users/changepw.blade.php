@extends('layout.index')
@section('title')
<title>Đổi mật khẩu</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Đổi mật khẩu</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              <form action="{{$users['id']}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Mật khẩu:</label>
                  <input type="password" class="form-control"  name="password" >
                </div>
                <div class="form-group">
                  <label >Nhập lại mật khẩu:</label>
                  <input type="password" class="form-control"  name="repassword" >
                </div>
                   
                <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
          </div>
@endsection