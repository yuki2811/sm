@extends('layout.index')
@section('title')
<title>Danh sách điểm</title>
@endsection
@section('content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary">Chi tiết điểm</h3>
              <a class="btn btn-success btn-xs delete_sem" role="button" href="{{ route('dsdiem', ['classid' => $clas['id'],'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ]) }}"><i class="fa fa-chevron-left" aria-hidden="true"></i>  quay lại</a>
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
                <div class="row">
                  <div class="col-6">
                    <h5>Tên: {{Illuminate\Support\Facades\Crypt::decryptString($std['first_name'])." ".Illuminate\Support\Facades\Crypt::decryptString($std['name'])}}</h5>
                    <h5>Lớp: {{$clas['name']}}</h5>
                    <h5>Môn học: {{$sub['name']}}</h5>
                  </div>
                  <div class="col-6">
                    <h5>Năm học: {{$sem['start_year']."-".$sem['end_year']}}</h5>
                    <h5>kì học: {{$subsem}}</h5>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-2"></div>
                  <div class="col-8">
                    @if($subsem == 1)
                    @if($sub['id'] !== 15)
                    <form action="{{route('editpoints', ['id' => $points['id'], 'classid' => $clas['id'], 'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ])}}" method="post">
                      {!!csrf_field() !!}
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Miệng:</label>
                          <div class="col-8">
                            <input class="form-control tx" type="number" name="mieng11" value="{{$points['mieng11']}}"> 
                            <input class="form-control tx" type="number" name="mieng21" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng21'])}}"> 
                            <input class="form-control tx" type="number" name="mieng31" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng31'])}}">
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Viết/15p:</label>
                          <div class="col-8">
                            <input class="form-control tx" type="number" name="tx11" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx11'])}}"> 
                            <input class="form-control tx" type="number" name="tx21" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx21'])}}"> 
                            <input class="form-control tx" type="number" name="tx31" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx31'])}}">
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 2:</label>
                          <div class="col-8">
                            <input class="form-control dk" type="number" name="tiet11" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet11'])}}"> 
                            <input class="form-control dk" type="number" name="tiet21" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet21'])}}"> 
                            <input class="form-control dk" type="number" name="tiet31" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet31'])}}">
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">KTHK:</label>
                          <div class="col-8">
                            <input class="form-control hk" type="number" name="thi1" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['thi1'])}}"> 
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <input id="result1" type="hidden" name="tongket1" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket1'])}}">
                          <input id="result3" type="hidden" name="tongket2" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket2'])}}">
                          <label class="col-2">TBM HK1:</label>
                          <div class="col-8">
                            <span id="result2" style="color: black;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket1'])}}</span>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input check" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                              Xác nhận kết quả
                            </label>
                            <div class="invalid-feedback">
                              Bạn phải xác nhận kết quả.
                            </div>
                          </div>
                        </div>
                      <button type="submit" class="btn btn-primary">Đồng ý</button>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Xem bản mã</button>
                    </form>
                    @else
                    <form action="{{route('editpoints', ['id' => $points['id'], 'classid' => $clas['id'], 'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ])}}" method="post">
                      {!!csrf_field() !!}
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Miệng:</label>
                          <div class="col-8">
                            <select class="form-control" name="mieng11">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng11'])}}" selected>{{$points['mieng11']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="mieng21">
                              <option  value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng21'])}}" selected>{{$points['mieng21']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="mieng31">
                              <option  value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng31'])}}" selected>{{$points['mieng31']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Viết/15p:</label>
                          <div class="col-8">
                            <select class="form-control " name="tx11">
                              <option  value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx11'])}}" selected>{{$points['tx11']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tx21">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx21'])}}" selected>{{$points['tx21']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tx31">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx31'])}}" selected>{{$points['tx31']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 2:</label>
                          <div class="col-8">
                            <select class="form-control " name="tiet11">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet11'])}}" selected>{{$points['tiet11']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tiet21">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet21'])}}" selected>{{$points['tiet21']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tiet31">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet31'])}}" selected>{{$points['tiet31']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">KTHK:</label>
                          <div class="col-8">
                            <select class="form-control " name="thi1">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['thi1'])}}" selected>{{$points['thi1']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">TBM HK1:</label>
                          <div class="col-8">
                            <select class="form-control " name="tongket1">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket1'])}}" selected>{{$points['tongket1']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                              Xác nhận kết quả
                            </label>
                            <div class="invalid-feedback">
                              Bạn phải xác nhận kết quả.
                            </div>
                          </div>
                        </div>
                      <button type="submit" class="btn btn-primary">Đồng ý</button>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Xem bản mã</button>
                    </form>

                    @endif
                    <!-- Modal kì 1 -->
                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog">                 
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2>Bản mã</h2>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form action="" method="">
                            {!!csrf_field() !!}
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">Điểm hệ số 1-Miệng:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['mieng11'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['mieng11'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['mieng21'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['mieng21'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['mieng31'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['mieng31'])}}@else
                                  @endif">
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">Điểm hệ số 1-Viết/15p:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tx11'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tx11'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tx21'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tx21'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tx31'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tx31'])}}@else
                                  @endif">
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">Điểm hệ số 2:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tiet11'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tiet11'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tiet21'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tiet21'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tiet31'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tiet31'])}}@else
                                  @endif">
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">KTHK:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['thi1'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['thi1'])}}@else
                                  @endif"> 
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">TBM HK1:</label>
                                <div class="col-8">
                                  <span id="result2" style="color: black;">@if($points['tongket1'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tongket1'])}}@else
                                  @endif</span>
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                          </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại bản rõ</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @else
                    @if($sub['id'] !== 15)
                    <form action="{{route('editpoints', ['id' => $points['id'], 'classid' => $clas['id'], 'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ])}}" method="post">
                      {!!csrf_field() !!}
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Miệng:</label>
                          <div class="col-8">
                            <input class="form-control tx" type="text" name="mieng12" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng12'])}}"> 
                            <input class="form-control tx" type="number" name="mieng22" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng22'])}}"> 
                            <input class="form-control tx" type="number" name="mieng32" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng32'])}}">
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Viết/15p:</label>
                          <div class="col-8">
                            <input class="form-control tx" type="number" name="tx12" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx12'])}}"> 
                            <input class="form-control tx" type="number" name="tx22" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx22'])}}"> 
                            <input class="form-control tx" type="number" name="tx32" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx32'])}}">
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 2:</label>
                          <div class="col-8">
                            <input class="form-control dk" type="number" name="tiet12" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet12'])}}"> 
                            <input class="form-control dk" type="number" name="tiet22" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet22'])}}"> 
                            <input class="form-control dk" type="number" name="tiet32" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet32'])}}">
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">KTHK:</label>
                          <div class="col-8">
                            <input class="form-control hk" type="number" name="thi2" min="0" max="10" step="0.001" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['thi2'])}}"> 
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <input id="result3" type="hidden" name="tongket1" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket1'])}}">
                          <input id="result1" type="hidden" name="tongket2" value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket2'])}}">
                          <label class="col-2">TBM HK2:</label>
                          <div class="col-8">
                            <span id="result2" style="color: black;">{{$points['tongket2']}}</span>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input check" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                              Xác nhận kết quả
                            </label>
                            <div class="invalid-feedback">
                              Bạn phải xác nhận kết quả.
                            </div>
                          </div>
                        </div>
                      <button type="submit" class="btn btn-primary">Đồng ý</button>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">Xem bản mã</button>
                    </form>
                    @else
                    <form action="{{route('editpoints', ['id' => $points['id'], 'classid' => $clas['id'], 'semid' => $sem['id'], 'subsem' => $subsem, 'subjectid' => $sub['id'] ])}}" method="post">
                      {!!csrf_field() !!}
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Miệng:</label>
                          <div class="col-8">
                            <select class="form-control" name="mieng12">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng12'])}}" selected>{{$points['mieng12']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="mieng22">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng22'])}}" selected>{{$points['mieng22']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="mieng32">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['mieng32'])}}" selected>{{$points['mieng32']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 1-Viết/15p:</label>
                          <div class="col-8">
                            <select class="form-control " name="tx12">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx12'])}}" selected>{{$points['tx12']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tx22">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx22'])}}" selected>{{$points['tx22']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tx32">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tx32'])}}" selected>{{$points['tx32']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">Điểm hệ số 2:</label>
                          <div class="col-8">
                            <select class="form-control " name="tiet12">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet12'])}}" selected>{{$points['tiet12']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tiet22">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet22'])}}" selected>{{$points['tiet22']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                            <select class="form-control " name="tiet32">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tiet32'])}}" selected>{{$points['tiet32']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">KTHK:</label>
                          <div class="col-8">
                            <select class="form-control " name="thi2">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['thi2'])}}" selected>{{$points['thi2']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <hr>
                      <div class="form-group">
                        <div class="row">
                          <label class="col-2">TBM HK2:</label>
                          <div class="col-8">
                            <select class="form-control " name="tongket2">
                              <option value="{{preg_replace('/[^a-zA-Z0-9.]/', '', $points['tongket2'])}}" selected>{{$points['tongket2']}}</option>
                              <option value="D">D</option>
                              <option value="CD">CD</option>
                            </select>
                          </div>
                          <div class="col-2"></div>
                        </div> 
                      </div>
                      <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                              Xác nhận kết quả
                            </label>
                            <div class="invalid-feedback">
                              Bạn phải xác nhận kết quả.
                            </div>
                          </div>
                        </div>
                      <button type="submit" class="btn btn-primary">Đồng ý</button>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">Xem bản mã</button>
                    </form>
                    @endif
                    <div class="modal fade" id="myModal2" role="dialog">
                      <div class="modal-dialog">                 
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2>Bản mã</h2>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form action="" method="">
                            {!!csrf_field() !!}
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">Điểm hệ số 1-Miệng:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['mieng12'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['mieng12'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['mieng22'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['mieng22'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['mieng32'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['mieng32'])}}@else
                                  @endif">
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">Điểm hệ số 1-Viết/15p:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tx12'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tx12'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tx22'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tx22'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tx32'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tx32'])}}@else
                                  @endif">
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">Điểm hệ số 2:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tiet12'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tiet12'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tiet22'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tiet22'])}}@else
                                  @endif"> 
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['tiet32'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tiet32'])}}@else
                                  @endif">
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">KTHK:</label>
                                <div class="col-8">
                                  <input class="form-control" type="text" name="" min="0" max="10" step="0.001" value="@if($points['thi2'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['thi2'])}}@else
                                  @endif"> 
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                            <hr>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-2">TBM HK1:</label>
                                <div class="col-8">
                                  <span id="result2" style="color: black;">@if($points['tongket2'] != null){{Illuminate\Support\Facades\Crypt::encryptString($points['tongket2'])}}@else
                                  @endif</span>
                                </div>
                                <div class="col-2"></div>
                              </div> 
                            </div>
                          </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Quay lại bản rõ</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  </div>
                  <div class="col-2"></div>
                </div>
              </div>
            </div>
          </div>
@endsection