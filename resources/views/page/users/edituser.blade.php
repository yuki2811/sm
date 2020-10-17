@extends('layout.index')
@section('title')
<title>Thiết lập người dùng</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Sửa thông tin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Thiết lập lớp giảng dạy</a>
                </li>
            </ul>
            <div class="tab-content">
              <div id="home" class="card-body tab-pane active">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              @if(session('thongbao'))
              <div class="alert alert-danger">
                  {{session('thongbao')}}
              </div>
              @endif
              <form action="{{$users['id']}}" method="POST">
                {!!csrf_field() !!}
                <div class="form-group">
                  <label >Tài khoản: {{$users['account']}}</label>
                </div>
                <div class="form-group">
                  <label >Tên:</label>
                  <input type="text" class="form-control" placeholder="Vd: Nguyễn Văn A" name="name" value="{{$users['name']}}">
                </div>
                <div class="form-group">
                  <label >Ngày sinh:</label>
                  <input type="date" class="form-control" name="birthday" value="{{$users['birthday']}}">
                </div>
                <div class="form-group">
                  <label >Môn giảng dạy:</label>
                  <select class="mdb-select md-form form-control" name="subjectid" >
                    <option value="{{$users['subject_id']}}" disabled selected><?php $subj = App\Subject::find($users['subject_id']); if ($subj == null || $users['subject_id'] == -1) {
                      echo "không có";
                    }else{ echo $subj['name']; } ?></option>
                    <option value="-1">Không có</option>
                    @foreach($subject as $sj)
                    <option value="{{$sj['id']}}">{{$sj['name']}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="form-group">
                  <label >Quyền:</label>
                  <select class="mdb-select md-form form-control" name="superadmin" >
                    <option value="{{$users['super_admin']}}" selected>
                    @if($users['super_admin'] == 1)
                    Quản trị viên
                    @else
                    Giáo viên
                    @endif
                    </option>
                    <option value="1">Quản trị viên</option>
                    <option value="2">Giáo viên</option>
                  </select> 
                </div>                     
                <button type="submit" class="btn btn-primary">Chấp nhận</button><a href="{{route('changepw',['id' => $users['id']])}}">         Đổi mật khẩu</a>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Xem mã hóa tài khoản</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Bản mã</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form>
                      {!!csrf_field() !!}
                      <div class="form-group">
                        <label >Tài khoản:</label>
                        <input type="text" class="form-control" name="" value="{{$users['account']}}">
                      </div>
                      <div class="form-group">
                        <label >Mật khẩu:</label>

                        <input type="text" class="form-control"  name="" value="{{$users['password']}}">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại</button>
                  </div>
                </div>
                
              </div>
            </div>
            <div id="menu1" class="card-body tab-pane fade">
              @if(count($errors)>0)
                      <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                          {{$err}}<br>
                        @endforeach
                      </div>
                    @endif
              @if(session('thongbao'))
              <div class="alert alert-danger">
                  {{session('thongbao')}}
              </div>
              @endif
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" title="Lọc và sắp xếp theo">
                        Lọc theo kì học
                        </a>
                        <div class="dropdown-menu" >
                          <p class="dropdown-item roleName_dropdown" style="cursor: pointer;" >Hiển thị tất cả</p>
                              @foreach($seme as $se)
                              <div class="dropdown-divider"></div>
                              <p class="dropdown-item roleName_dropdown" style="cursor: pointer;">{{$se['start_year']}}-{{$se['end_year']}}</p>
                              @endforeach
                        </div>
                    </li>
                </ul>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Chọn</th>
                          <th>Tên lớp</th>
                          <th>Khối</th>
                          <th>Kì học</th>
                      </tr>
                  </thead>
                  <tbody id="myTable">
                      <?php

                          foreach($classes as $rl){
                            ?>
                      <tr >
                          <td align="center">
                              <div class="form-group custom-control custom-checkbox">
                                  <label>
                                  <input name="clas[]" 
                                      <?php
                                          $classe = App\User::find($users['id'])->classes->toArray();
                                          
                                          foreach($classe as $rls){
                                              if($rls['id'] == $rl['id']){
                                                  echo "checked";
                                              }
                                          } ?>
                                      type="checkbox" class="custom-control-input" value="{{$rl['id']}}">
                                  <span class="custom-control-label"></span>
                                  </label>
                              </div>
                          </td>
                          <td>{{$rl['name']}}</td> 
                          <td><?php $khoi = App\Grade::find($rl['grade_id'])->toArray(); echo $khoi['name']; ?></td>
                          <td><?php $sem = App\Semester::find($rl['semester_id'])->toArray();  echo $sem['start_year']."-".$sem['end_year']; ?></td>
                      </tr>
                      <?php }?>
                  </tbody>
              </table>
              <button type="submit" class="btn btn-primary">Chấp nhận</button>
              </form>
            </div>
            </div>
          </div>
@endsection