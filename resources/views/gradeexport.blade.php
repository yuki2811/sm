
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th colspan="17" align="center">Danh sách thống kê học lực theo khối</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Khối:</td>
                        <td>{{$grade['name']}}</td>
                        <td></td>
                        <td>Năm học:</td>
                        <td>{{$semester['start_year']."-".$semester['end_year']}}</td>
                        <td></td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Kì học:</td>
                        <td>@if($subsem == 1) Kì I @elseif($subsem == 2) Kì II @else Cả năm @endif</td>
                        <td></td>
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
                      <th style="border: 1px solid black;" rowspan="2">Tên môn học</th>
                      <th style="border: 1px solid black;" colspan="2">8.0-10</th>
                      <th style="border: 1px solid black;" colspan="2">6.5-7.9</th>
                      <th style="border: 1px solid black;" colspan="2">5.0-6.4</th>
                      <th style="border: 1px solid black;" colspan="2">3.5-4.9</th>
                      <th style="border: 1px solid black;" colspan="2">0-3.4</th>
                      <th style="border: 1px solid black;" colspan="2">TB trở lên</th>
                      <th style="border: 1px solid black;" colspan="2">D</th>
                      <th style="border: 1px solid black;" colspan="2">CD</th>
                    </tr>
                    <tr align="center">
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                      <th align="center" style="border: 1px solid black;" >SL</th>
                      <th align="center" style="border: 1px solid black;" >%</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    @foreach($data as $value)
                    <tr>                
                      <td style="border: 1px solid black;" align="center">{{$value['name']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['gioi']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['gioi']/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['kha']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['kha']/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['tb']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['tb']/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['yeu']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['yeu']/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['kem']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['kem']/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['gioi']+$value['kha']+$value['tb']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round(($value['gioi']+$value['kha']+$value['tb'])/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['D']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['D']/$siso*100, 2)}}%</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{$value['CD']}}</td>
                      <td align="center" style="border: 1px solid black; width: 10px;">{{round($value['CD']/$siso*100, 2)}}%</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
</body>
