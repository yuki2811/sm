@extends('layout.index')
@section('title')
<title>Thống kê theo lớp</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Thống kê học lực theo lớp</h3>
              <button  class="btn btn-primary btn-xs delete_sem"  data-url=""><i class="fa fa-print" aria-hidden="true"></i> <a style="color: white;" href="{{ route('admin.classexport', ['sems' => $sem['id'],'classess' => $clas['id'],'grades' => $grade,'subsems' => $subsem]) }}">Xuất excel</a></button>
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
              <div class="container">
                <div class="row">
                  <div class="col-6">
                    <h5>Lớp: {{$clas['name']}}</h5>
                    <h5>Sĩ số: {{$siso}}</h5>
                  </div>
                  <div class="col-6">
                    <h5>Năm học: {{$sem['start_year']."-".$sem['end_year']}}</h5>
                    <h5>kì học: {{$subsem}}</h5>
                  </div>
                </div>
                <hr>
                
              </div>
              <div>
                <table class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th rowspan="2">Tên môn học</th>
                      <th colspan="2">8.0-10</th>
                      <th colspan="2">6.5-7.9</th>
                      <th colspan="2">5.0-6.4</th>
                      <th colspan="2">3.5-4.9</th>
                      <th colspan="2">0-3.4</th>
                      <th colspan="2">TB trở lên</th>
                      <th colspan="2">D</th>
                      <th colspan="2">CD</th>
                    </tr>
                    <tr align="center">
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                      <th >SL</th>
                      <th >%</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($points as $value)
                    <tr>                
                      <td align="center">{{$value['name']}}</td>
                      <td align="center">{{$value['gioi']}}</td>
                      <td align="center">{{round($value['gioi']/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['kha']}}</td>
                      <td align="center">{{round($value['kha']/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['tb']}}</td>
                      <td align="center">{{round($value['tb']/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['yeu']}}</td>
                      <td align="center">{{round($value['yeu']/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['kem']}}</td>
                      <td align="center">{{round($value['kem']/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['gioi']+$value['kha']+$value['tb']}}</td>
                      <td align="center">{{round(($value['gioi']+$value['kha']+$value['tb'])/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['D']}}</td>
                      <td align="center">{{round($value['D']/$siso*100, 2)}}%</td>
                      <td align="center">{{$value['CD']}}</td>
                      <td align="center">{{round($value['CD']/$siso*100, 2)}}%</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection