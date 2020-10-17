@extends('layout.index')
@section('title')
<title>Danh sách người dùng</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h3>
              <a class="btn btn-primary create_sem" href="{{url('admin/users/themnguoidung')}}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
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
                        Lọc theo quyền
                        </a>
                        <div class="dropdown-menu" >
                          <p class="dropdown-item roleName_dropdown" style="cursor: pointer;" >Hiển thị tất cả</p>
                              <div class="dropdown-divider"></div>
                              <p class="dropdown-item roleName_dropdown" style="cursor: pointer;">Admin</p>
                              <div class="dropdown-divider"></div>
                              <p class="dropdown-item roleName_dropdown" style="cursor: pointer;">Quản trị viên</p>
                              <div class="dropdown-divider"></div>
                              <p class="dropdown-item roleName_dropdown" style="cursor: pointer;">Giáo viên</p>
                        </div>
                    </li>
                </ul>
                <table  class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tên</th>
                      <th>Ngày sinh</th>
                      <th>Tên đăng nhập</th>
                      <th>Quyền</th>
                      <th>Môn giảng dạy</th>
                      <th>Lớp giảng dạy</th>
                      <th>trạng thái</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                  	@foreach($user as $value)
                    <tr>
                      <td>{{$value['name']}}</td>
                      <td>
                        @if($value['birthday'] == null)
                        @else
                        <?php 
                      $myDateTime = DateTime::createFromFormat('Y-m-d', $value['birthday']);
                      $formattedweddingdate = $myDateTime->format('d-m-Y');
                      echo $formattedweddingdate;?>
                        @endif
                      </td>
                      <td>{{$value['account']}}</td>
                      <td>
                        @if($value['super_admin'] == 0)
                        Admin
                        @elseif($value['super_admin'] == 1)
                        Quản trị viên
                        @elseif($value['super_admin'] == 2)
                        Giáo viên
                        @endif
                      </td>
                      <td><?php $subjects = App\Subject::find($value['subject_id']); ?>
                      @if($subjects == null || $value['subject_id'] == -1)
                      không có
                      @else
                      {{$subjects['name']}}
                      @endif
                      </td>
                      <?php $group = App\User::find($value['id'])->classes->toArray(); ?>
                      <td>  
                        @foreach($group as $gr)
                        <p>-Lớp {{$gr['name']}}</p><p><?php $sem = App\Semester::find($gr['semester_id']);
                              echo $sem['start_year']."-".$sem['end_year'];
                         ?></p>
                        @endforeach
                      </td>
                      <td>
                        @if($value['active'] == 0)
                        Đang hoạt động
                        @else
                        Ngừng hoạt động
                        @endif
                      </td>
                      <td style="text-align:center;">
                        @if($userLogin->super_admin == 0 &&  $value['super_admin'] == 0)
                        <a class="btn btn-info" href="suaadmin/{{$value['id']}}" role="button">Sửa thông tin</a>
                        @endif
                        @if($value['super_admin'] == 0)
                          
                        @else
                          <a class="btn btn-info" href="suanguoidung/{{$value['id']}}" role="button">Sửa</a>
                          <a class="btn btn-warning" href="channguoidung/{{$value['id']}}" role="button">
                          @if($value['active'] == 0)
                        Chặn
                        @else
                        Bỏ chặn
                        @endif
                          
                          </a>
                          <form method="POST" action="{{route('destroyuser', ['id' => $value['id']])}}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button class="btn btn-danger" href="" type="submit">Xóa</button>
                          </form>
                              
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection