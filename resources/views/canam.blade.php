<body>
  <table>
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th colspan="5" align="center">Danh sách điểm</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Lớp:</td>
                        <td>{{$classes['name']}}</td>
                        <td></td>
                        <td>Môn học:</td>
                        <td>{{$subject['name']}}</td>
                      </tr>
                      <tr>
                        <td>Năm học:</td>
                        <td>{{$semester['start_year']."-".$semester['end_year']}}</td>
                        <td></td>
                        <td>Kì học:</td>
                        <td>@if($subsem == 1) Kì I @elseif($subsem == 2) Kì II @else Cả năm @endif</td>
                      </tr>
                    </tbody>
                  </table>
	<table class="table dtTable table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th style="border: 1px solid black;" align="center">Mã học sinh</th>
                      <th style="border: 1px solid black;" align="center">Tên học sinh</th>
                      <th style="border: 1px solid black;" align="center">TBM kì I</th>
                      <th style="border: 1px solid black;" align="center">TBM kì II</th>
                      <th style="border: 1px solid black;" align="center">TBMCN</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($data as $value)
                    <tr>                
                      <td style="border: 1px solid black;width: 10px;" align="center">
                        <?php 
                                $gradeid = App\Student::find($value['student_id'])->toArray();
                                echo $gradeid['first_id']."".$gradeid['id']; ?></td>                
                      <td style="border: 1px solid black;">
                        <?php 
                                echo Illuminate\Support\Facades\Crypt::decryptString($gradeid['first_name'])." ".Illuminate\Support\Facades\Crypt::decryptString($gradeid['name']); ?></td>
                      <td style="border: 1px solid black;width: 10px;" align="center">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tongket1'])}}</td>
                      <td style="border: 1px solid black;width: 10px;" align="center">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tongket2'])}}</td>
                      <td style="border: 1px solid black;width: 10px;" align="center">{{preg_replace('/[^a-zA-Z0-9.]/', '', $value['tongket'])}}</td>
                    @endforeach

                  </tbody>
                </table>
</body>