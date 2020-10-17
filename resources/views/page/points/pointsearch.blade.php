@extends('layout.index')
@section('title')
<title>Điểm</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Tìm kiếm điểm</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              <div class="container">
                <form class="pointform" action="diem" method="post">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="form-group col-3">
                      <label >Chọn năm học: </label>
                      <select class="form-control" name="semester">
                        {{$count = 1}}
                        @foreach($sem as $value)
                        <option value="{{$value['id']}}" <?php if($count == 1){
                          echo " selected";
                          $count++;
                        } ?>
                        >{{$value['start_year']."-".$value['end_year']}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label >Chọn khối học: </label>
                      <select class="form-control " name="grade">
                        <option value="" selected disabled>---</option>
                        <option value="1">Khối 10</option>
                        <option value="2">Khối 11</option>
                        <option value="3">Khối 12</option>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label >Chọn lớp học: </label>
                      <select class="form-control" name="classes" >
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label >Chọn môn học: </label>
                      <select class="form-control " name="subject">
                      </select>
                    </div>
                  </div>
                  <div class="form-group" style="margin-left: 45%; display: inline-block;">
                      <label >Chọn kì học: </label>
                      <select class="form-control " name="subsem">
                        <option value="" selected disabled>---</option>
                        <option value="1">Kì 1</option>
                        <option value="2">Kì 2</option>
                        <option value="3">Cả năm</option>
                      </select>
                    </div>

                  <button type="submit" class="btn btn-primary center" style="margin-left: 45%;">Tìm kiếm</button>
                </form>
              </div>
              
            </div>
          </div>
@endsection