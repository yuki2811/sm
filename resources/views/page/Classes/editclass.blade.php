@extends('layout.index')
@section('title')
<title>Sửa lớp học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Sửa thông tin lớp học</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              <form action="{{$info->id}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Tên lớp học:</label>
                  <input type="text" class="form-control" placeholder="Vd: Lớp 10a1" name="name" value="{{$info->name}}">
                </div>
                <div class="form-group">
                  <label >Khối học:</label>
                  <select class="mdb-select md-form" name="gradeid" >
                    <option value="{{$grades['id']}}" selected>{{$grades['name']}}</option>
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
                    <option value="{{$semes['id']}}" selected>{{$semes['start_year']."-".$semes['end_year']}}</option>
                    @foreach($semester as $se)
                    <option value="{{$se['id']}}">{{$se['start_year']."_".$se['end_year']}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="form-group">
                  <label >Giáo viên chủ nhiệm:</label>
                  <select class="mdb-select md-form" name="userid" >
                    @if(isset($main['id']))
                    <option value="{{$main['id']}}" selected>{{$main['name']}}</option>
                    @else
                    <option value="" disabled="" selected>Chọn giáo viên chủ nhiệm</option>
                    @endif
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