@extends('layout.index')
@section('title')
<title>Quản lý lớp học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Danh sách các lớp học</h3>
              <a class="btn btn-primary create_sem @if($userLogin->super_admin != 0 && $userLogin->super_admin != 1 )
                disabled
                @endif" href="{{url('admin/themlophoc')}}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
              <button  class="btn btn-danger btn-xs delete-all-class delete_sem" data-url="" @if($userLogin->super_admin != 0 && $userLogin->super_admin != 1 )
                disabled
                @endif><i class="fa fa-trash" aria-hidden="true"
              ></i> Xóa</button>
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
                <ul class="navbar-nav mr-auto" style="display: inline-block;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" title="Lọc và sắp xếp theo">
                        Lọc và sắp xếp khối
                        </a>
                        <div class="dropdown-menu">
                          <p class="dropdown-item roleName_dropdown" style="cursor: pointer;" >Hiển thị tất cả</p>
                          @foreach($grade as $ar)
                              <div class="dropdown-divider"></div>
                              <p class="dropdown-item roleName_dropdown" style="cursor: pointer;">{{$ar['name']}}</p>
                          @endforeach
                        </div>
                    </li>
                </ul>
                <table class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="check_all"></th>
                      <th>Mã lớp</th>
                      <th>Tên</th>
                      <th>Khối</th>
                      <th>Kì học</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($clas as $value)
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
                      <td>{{$value['name']}}</td>
                      <td><?php 
                                $gradeid = App\Grade::find($value['grade_id'])->toArray();
                                echo $gradeid['name']; ?></td>
                      <td><?php 
                                $semid = App\Semester::find($value['semester_id'])->toArray();
                                echo $semid['start_year']."-".$semid['end_year']; ?></td>
                      <td style="text-align:center;"><a class="btn btn-info @if($userLogin->super_admin != 0 && $userLogin->super_admin != 1 )
                disabled
                @endif" href="sualophoc/{{$value['id']}}" role="button">Sửa</a>
                          <a class="btn btn-primary" href="hocsinh/{{$value['id']}}/{{$gradeid['id']}}" role="button">Xem lớp</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection