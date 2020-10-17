@extends('layout.index')
@section('title')
<title>Thêm học sinh</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Thêm mới học sinh lớp: {{$clas['name']}}. Kì học: {{$sem['start_year']."-".$sem['end_year']}}</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
                    
              <form action="{{ route('addhs', ['classid' => $clas['id'], 'gradeid' => $gradeid]) }}" method="POST">
                {!!csrf_field() !!}
                <input type="text" hidden="" class="form-control" name="classid" value="{{$clas['id']}}">
                <div class="form-group">
                  <label >Họ:</label>
                  <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn ..." name="firstname" >
                </div>
                <div class="form-group">
                  <label >Tên:</label>
                  <input type="text" class="form-control" placeholder="Vd: Anh" name="name" >
                </div>
                <div class="form-group">
                  <label >Ngày sinh:</label>
                  <input type="date" class="form-control" name="birthday">
                </div>
                <div class="form-group">
                  <label >Giới tính:</label>
                  <select class="mdb-select md-form form-control" name="sex" >
                    <option value="" disabled selected>chọn giới tính:</option>
                    <option value="nam">nam</option>
                    <option value="nữ">nữ</option>
                  </select> 
                </div>
                <div class="form-group">
                  <label >Quê quán:</label>
                  <input type="text" class="form-control" placeholder="" name="birthplace" >
                </div>                     
                <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
          </div>
@endsection