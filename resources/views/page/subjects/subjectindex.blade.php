@extends('layout.index')
@section('title')
<title>Quản lý Môn học</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Danh sách các Môn học</h3>
              <a class="btn btn-primary create_sem" href="{{url('admin/themmonhoc')}}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
              <button  class="btn btn-danger btn-xs delete-all-subject delete_sem" data-url=""><i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
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
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" title="Lọc và sắp xếp theo">
                        Lọc và sắp xếp
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
                      <th>Mã môn học</th>
                      <th>Tên</th>
                      <th>Mô tả</th>
                      <th>Khối học</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($subject as $value)
                    <tr>
                      <td style="text-align:center;">
                        @if($value['id'] == 15)
                        @else
                        <div class="form-group custom-control custom-checkbox">
                            <label>
                            <input type="checkbox" class="custom-control-input checkbox" data-id="{{$value['id']}}">
                            <span class="custom-control-label"></span>
                            </label>
                        </div>
                        @endif
                      </td>
                      <td>{{$value['first_id']."".$value['id']}}</td>
                      <td>{{$value['name']}}</td>
                      <td>{{$value['description']}}</td>
                      <td><?php 
                                $gradeid = App\Grade::find($value['grade_id'])->toArray();
                                echo $gradeid['name']; ?></td>
                      <td style="text-align:center;"><a class="btn btn-info" href="suamonhoc/{{$value['id']}}" role="button">Sửa thông tin</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection