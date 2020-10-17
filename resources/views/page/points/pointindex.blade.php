@extends('layout.index')
@section('title')
<title>Danh sách điểm</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Lớp: {{$clas['name']}} | Môn: {{$sub['name']}} | Năm học: {{$sem['start_year']."-".$sem['end_year']}} | Kì: @if($subsem == 1) 1 @elseif($subsem == 2) 2 @else Cả năm @endif </h3>
              <button  class="btn btn-primary btn-xs delete_sem"  data-url=""><i class="fa fa-print" aria-hidden="true"></i> <a style="color: white;" href="{{ route('admin.pointexport', ['sems' => $sem['id'],'grades' => $sub['grade_id'],'subjects' => $sub['id'],'classess' => $clas['id'],'subsems' => $subsem]) }}">Xuất excel</a></button>
              <a class="btn btn-success btn-xs delete_sem" role="button" href="{{url('admin/quaylai')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i>  quay lại</a>
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
                    @if($subsem == 1 || $subsem == 2)
                    <tr align="center">
                      <th>Mã học sinh</th>
                      <th>Tên học sinh</th>
                      <th colspan="3">Điểm hệ số 1-Miệng</th>
                      <th colspan="3">Điểm hệ số 1-Viết/15p</th>
                      <th colspan="3">Điểm hệ số 2</th>
                      <th >KTHK</th>
                      @if($subsem == 1)
                      <th >TBM HK1</th>
                      @else
                      <th >TBM HK2</th>
                      @endif
                      <th>Hành động</th>
                    </tr>
                    @else
                    <tr align="center">
                      <th>Mã học sinh</th>
                      <th>Tên học sinh</th>
                      <th >TBM HK1</th>
                      <th >TBM HK2</th>
                      <th >TBM cả năm</th>
                      <th>Hành động</th>
                    </tr>
                    @endif
                  </thead>
                  <tbody id="myTable">
                    @if($subsem == 1)
                    @foreach($points as $value)
                    <tr>
                      <td align="center">
                        <?php 
                                $gradeid = App\Student::find($value['student_id'])->toArray();
                                echo $gradeid['first_id']."".$gradeid['id']; ?></td>                
                      <td>
                        <?php 
                                echo Illuminate\Support\Facades\Crypt::decryptString($gradeid['first_name'])." ".Illuminate\Support\Facades\Crypt::decryptString($gradeid['name']); ?></td>
                      <td align="center">{{$value['mieng11']}}</td>
                      <td align="center">{{$value['mieng21']}}</td>
                      <td align="center">{{$value['mieng31']}}</td>
                      <td align="center">{{$value['tx11']}}</td>
                      <td align="center">{{$value['tx21']}}</td>
                      <td align="center">{{$value['tx31']}}</td>
                      <td align="center">{{$value['tiet11']}}</td>
                      <td align="center">{{$value['tiet21']}}</td>
                      <td align="center">{{$value['tiet31']}}</td>
                      <td align="center">{{$value['thi1']}}</td>
                      <td align="center">{{$value['tongket1']}}</td>
                    <td align="center"><a class="btn btn-warning <?php
                      $clas3 = App\User::find($userLogin->id)->classes->toArray();
                      $count = 1;
                      if($userLogin->super_admin == 0){
                         $count++;
                         }elseif($userLogin->super_admin == 1){
                          $count++;
                         }else{
                          foreach ($clas3 as $value11) {
                               if ($value11['id'] == $clas['id'] && $userLogin->subject_id == $sub['id'] ) {
                                   $count++;
                                }
                            }
                         }
                      
                      if($count == 1) echo "disabled";
                      ?>

                      " href="{{ route('editpoint', ['id' => $value['id'], 'classid' => $clas['id'],'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ]) }}"  role="button">Sửa</a></td>
                    </tr>
                    @endforeach
                    @elseif($subsem == 2)
                    @foreach($points as $value)
                    <tr>                
                      <td align="center">
                        <?php 
                                $gradeid = App\Student::find($value['student_id'])->toArray();
                                echo $gradeid['first_id']."".$gradeid['id']; ?></td>                
                      <td>
                        <?php 
                                echo Illuminate\Support\Facades\Crypt::decryptString($gradeid['first_name'])." ".Illuminate\Support\Facades\Crypt::decryptString($gradeid['name']); ?></td>
                      <td align="center">{{$value['mieng12']}}</td>
                      <td align="center">{{$value['mieng22']}}</td>
                      <td align="center">{{$value['mieng32']}}</td>
                      <td align="center">{{$value['tx12']}}</td>
                      <td align="center">{{$value['tx22']}}</td>
                      <td align="center">{{$value['tx32']}}</td>
                      <td align="center">{{$value['tiet12']}}</td>
                      <td align="center">{{$value['tiet22']}}</td>
                      <td align="center">{{$value['tiet32']}}</td>
                      <td align="center">{{$value['thi2']}}</td>
                      <td align="center">{{$value['tongket2']}}</td>
                    <td align="center"><a class="btn btn-warning 
                      <?php
                      $clas3 = App\User::find($userLogin->id)->classes->toArray();
                      $count = 1;
                      if($userLogin->super_admin == 0){
                         $count++;
                         }elseif($userLogin->super_admin == 1){
                          $count++;
                         }else{
                          foreach ($clas3 as $value11) {
                               if ($value11['id'] == $clas['id'] && $userLogin->subject_id == $sub['id'] ) {
                                   $count++;
                                }
                            }
                         }
                      
                      if($count == 1) echo "disabled";
                      ?>
                      
                      " href="{{ route('editpoint', ['id' => $value['id'], 'classid' => $clas['id'],'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ]) }}" role="button">Sửa</a></td>
                    </tr>
                    @endforeach
                    @else
                    @foreach($points as $value)
                    <tr>                
                      <td align="center">
                        <?php 
                                $gradeid = App\Student::find($value['student_id'])->toArray();
                                echo $gradeid['first_id']." ".$gradeid['id']; ?></td>                
                      <td>
                        <?php 
                                echo Illuminate\Support\Facades\Crypt::decryptString($gradeid['first_name'])." ".Illuminate\Support\Facades\Crypt::decryptString($gradeid['name']); ?></td>
                      <td align="center">{{$value['tongket1']}}</td>
                      <td align="center">{{$value['tongket2']}}</td>
                      <td align="center">{{$value['tongket']}}</td>
                      <td></td>
                    </tr>
                    @endforeach
                    @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection