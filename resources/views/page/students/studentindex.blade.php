@extends('layout.index')
@section('title')
<title>Quản lý học sinh</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Danh sách các học sinh lớp: {{$clas['name']}}. Kì học: {{$sem['start_year']."-".$sem['end_year']}} </h3>
              <a class="btn btn-success create_sem " href="{{ route('admin.statusexport', ['classid' => $clas['id'], 'gradeid' => $gradeid]) }}" role="button"><i class="fa fa-print" aria-hidden="true"></i> Xuất excel</a>
              <a class="btn btn-primary delete_sem @if($userLogin->super_admin == 0 || $userLogin->super_admin == 1 || $userLogin->main == $clas['id'] )
                @else
                disabled
                @endif" href="{{ route('themhs', ['classid' => $clas['id'], 'gradeid' => $gradeid]) }}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới </a>
              <button  class="btn btn-danger btn-xs delete-all-student delete_sem" data-idclass="{{$clas['id']}}" data-url="" @if($userLogin->super_admin == 0 || $userLogin->super_admin == 1 || $userLogin->main == $clas['id'] )
                @else
                disabled
                @endif><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
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
                <p style="color: black;">Giáo viên chủ nhiệm: {{ isset($main['name']) ? $main['name'] : 'Không có'}}</p>
                <table class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="check_all"></th>
                      <th>Mã học sinh</th>
                      <th>Họ</th>
                      <th>Tên</th>
                      <th>Ngày sinh</th>
                      <th>Giới tính</th>
                      <th>Quê quán</th>
                      <th>Hạnh kiểm</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($student as $value)
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
                      <td>{{$value['first_name']}}</td>
                      <td>{{$value['name']}}</td>
                      <td><?php $date=date_create($value['birthday']); ?>
                      {{date_format($date,"d-m-Y")}}</td>
                      <td>{{$value['sex']}}</td>
                      <td>{{$value['birthplace']}}</td>
                      <td align="center">
                      @if($value['status'] == 0 && $value['status'] !== null)
                      Tốt
                      @elseif($value['status'] == 1)
                      Khá
                      @elseif($value['status'] == 2)
                      Trung bình
                      @elseif($value['status'] == 3)
                      Yếu
                      @else
                      chưa có
                      @endif
                    </td>
                      <td style="text-align:center;"><a class="btn btn-info @if($userLogin->super_admin == 0 || $userLogin->super_admin == 1 || $userLogin->main == $clas['id'] )
                @else
                disabled
                @endif" href="{{ route('suahocsinh', ['id' => $value['id'], 'classid' => $clas['id'], 'gradeid' => $gradeid]) }}" role="button">Sửa</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection