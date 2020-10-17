@extends('layout.index')
@section('title')
<title>Thêm lớp học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Thêm mới lớp học</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              <form action="{{asset('admin/themlophoc')}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Tên lớp học:</label>
                  <input type="text" class="form-control" placeholder="Vd: 10a1" name="name" >
                </div>
                <div class="form-group">
                  <label >Khối học:</label>
                  <select class="mdb-select md-form" name="gradeid" >
                    <option value="" disabled selected>Chọn khối học</option>
                    @foreach($grade as $gr)
                    @if($gr['id'] != 5)
                    <option value="{{$gr['id']}}">{{$gr['name']}}</option>
                    @endif
                    @endforeach
                  </select> 
                </div>            
                <div class="form-group">
                  <label >Năm học:</label>
                  <select class="mdb-select md-form" name="semesterid" >
                    <option value="" disabled selected>Chọn Năm học</option>
                    @foreach($semester as $se)
                    <option value="{{$se['id']}}">{{$se['start_year']."_".$se['end_year']}}</option>
                    @endforeach
                  </select> 
                </div> 
                <div class="form-group">
                  <label >Giáo viên chủ nhiệm:</label>
                  <select class="mdb-select md-form" name="userid" >
                    <option value="" disabled selected>Chọn giáo viên chủ nhiệm</option>
                    @foreach($users as $us)
                    <option value="{{$us['id']}}">{{$us['name']." - ".$us['account']}}</option>
                    @endforeach
                  </select> 
                </div>
                <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
          </div>
@endsection