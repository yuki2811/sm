@extends('layout.index')
@section('title')
<title>Quản lý kì học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Danh sách các năm học</h3>
              <a class="btn btn-primary create_sem" href="{{url('admin/themkihoc')}}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
              <button  class="btn btn-danger btn-xs delete-all-sem delete_sem" data-url=""><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
            </div>
            <div class="card-body">
              @if(session('thongbao'))
              <div class="alert alert-success">
                  {{session('thongbao')}}
              </div>
              @endif
              @if(session('canhbao'))
              <div class="alert alert-danger">
                  {{session('canhbao')}}
              </div>
              @endif
              <div class="table-responsive">
                <table class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="check_all"></th>
                      <th>Mã năm</th>
                      <th>Tên</th>
                      <th>Mô tả</th>
                      <th>ngày tạo</th>
                      <th>ngày cập nhật</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sem as $value)
                    <tr>
                      <td style="text-align:center;">
                        <div class="form-group custom-control custom-checkbox">
                            <label>
                            <input type="checkbox" class="custom-control-input checkbox" data-id="{{$value['id']}}">
                            <span class="custom-control-label"></span>
                            </label>
                        </div>
                      </td>
                      <td>{{$value['first_id']."".$value['id']}}</td>
                      <td>{{$value['start_year']."-".$value['end_year']}}</td>
                      <td>{{$value['description']}}</td>
                      <td>{{$value['created_at']}}</td>
                      <td>{{$value['updated_at']}}</td>
                      <td style="text-align:center;"><a class="btn btn-info" href="suakihoc/{{$value['id']}}" role="button">Sửa</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection