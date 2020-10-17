<body>
  <table>
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th colspan="13" align="center">Danh sách điểm</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Lớp:</td>
                        <td>{{$classes['name']}}</td>
                        <td></td>
                        <td>Môn học:</td>
                        <td>{{$subject['name']}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td>Năm học:</td>
                        <td>{{$semester['start_year']."-".$semester['end_year']}}</td>
                        <td></td>
                        <td>Kì học:</td>
                        <td>@if($subsem == 1) Kì I @elseif($subsem == 2) Kì II @else Cả năm @endif</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
	<table class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th style="border: 1px solid black;" align="center">Mã học sinh</th>
                      <th style="border: 1px solid black;" align="center">Tên học sinh</th>
                      <th style="border: 1px solid black;" colspan="3" align="center">Điểm hệ số 1-Miệng</th>
                      <th style="border: 1px solid black;" colspan="3" align="center">Điểm hệ số 1-Viết/15p</th>
                      <th style="border: 1px solid black;" colspan="3" align="center">Điểm hệ số 2</th>
                      <th style="border: 1px solid black;" align="center">Điểm thi</th>
                      <th style="border: 1px solid black;" align="center">TBM</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($data as $value)
                    <tr>                
                      <td style="border: 1px solid black;" align="center">
                        <?php 
                                $gradeid = App\Student::find($value['student_id'])->toArray();
                                echo $gradeid['first_id']." ".$gradeid['id']; ?></td>                
                      <td style="border: 1px solid black;">
                        <?php 
                                echo Illuminate\Support\Facades\Crypt::decryptString($gradeid['first_name'])." ".Illuminate\Support\Facades\Crypt::decryptString($gradeid['name']); ?></td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['mieng12'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['mieng22'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['mieng32'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tx12'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tx22'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tx32'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tiet12'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tiet22'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tiet32'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['thi2'])}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tongket2'])}}</td>
                    @endforeach

                  </tbody>
                </table>
</body>