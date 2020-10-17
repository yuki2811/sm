@extends('layout.index')
@section('title')
<title>Thêm kì học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Thêm mới năm học</h3>
            </div>
            <div class="card-body">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              <form action="{{asset('admin/themkihoc')}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label>Chọn năm học bắt đầu:</label>
                  <select class="mdb-select md-form" name="start_year" >
                    <option value="" disabled selected>Chọn năm bắt đầu:</option>
                    <script type="text/javascript">
                      var myDate = new Date();
                      var year = myDate.getFullYear();
                      for (var i = 1990; i < year+20; i++) {
                        document.write('<option value="'+i+'">'+i+'</option>');
                      }
                    </script>
                  </select> 
                </div>            
                <div class="form-group">
                  <label >Mô tả:</label>
                  <input type="text" class="form-control" placeholder="" name="description" >
                </div>
                <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
          </div>
@endsection