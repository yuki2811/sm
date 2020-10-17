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
                      </tr>
                      <tr>
                        <th colspan="7" align="center">Danh sách học sinh</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td></td>
                        <td>Lớp:</td>
                        <td>{{$clas['name']}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>Năm học: </td>
                        <td>{{$sem['start_year']."-".$sem['end_year']}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
	                <table>
                  <thead>
                    <tr>
                    	<th style="border: 1px solid black;" align="center">Mã học sinh</th>
                      <th style="border: 1px solid black;" align="center">Họ</th>
                      <th style="border: 1px solid black;" align="center">Tên</th>
                      <th style="border: 1px solid black;" align="center">Ngày sinh</th>
                      <th style="border: 1px solid black;" align="center">Giới tính</th>
                      <th style="border: 1px solid black;" align="center">Quê quán</th>
                      <th style="border: 1px solid black;" align="center">Hạnh kiểm</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($data as $value)
                    <tr>
                    	<td style="border: 1px solid black;">{{$value['first_id']."".$value['id']}}</td>
                      <td style="border: 1px solid black;">{{$value['first_name']}}</td>
                      <td style="border: 1px solid black;">{{$value['name']}}</td>
                      <td style="border: 1px solid black;"><?php $date=date_create($value['birthday']); ?>
                      {{date_format($date,"d-m-Y")}}</td>
                      <td style="border: 1px solid black;">{{$value['sex']}}</td>
                      <td style="border: 1px solid black;">{{$value['birthplace']}}</td>
                      <td style="border: 1px solid black;" align="center">
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
                    </tr>
                    @endforeach
                  </tbody>
                </table>
</body>