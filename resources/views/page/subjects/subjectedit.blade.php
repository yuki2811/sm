@extends('layout.index')
@section('title')
<title>Sửa môn học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Sửa thông tin môn học</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              <form action="{{$subject->id}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Tên lớp học:<span style="color: red;">*</span></label></label>
                  <input type="text" class="form-control" placeholder="Vd: Toán 10" name="name" value="{{$subject->name}}">
                </div>
                <div class="form-group">
                  <label >Mô tả:</label>
                  <input type="text" class="form-control" placeholder="Mô tả về môn học..." name="description" value="{{$subject->description}}">
                </div>
                <div class="form-group">
                  <select class="mdb-select md-form" name="gradeid" >
                    <option value="{{$grades['id']}}" selected>{{$grades['name']}}</option>
                    @foreach($grade as $gr)
                    <option value="{{$gr['id']}}">{{$gr['name']}}</option>
                    @endforeach
                  </select> <span style="color: red;">   *</span>
                </div>            
                <p>Thông tin "<span style="color: red;">*</span>" không được để trống.</p>           
                <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
          </div>
@endsection