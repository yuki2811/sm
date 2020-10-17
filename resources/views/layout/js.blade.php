<script type="text/javascript">
	$(document).ready(function () {
		$('.dtTable').DataTable({
                responsive: true,
                "language": {
                    "sProcessing":   "Đang xử lý...",
                    "sLengthMenu":   "Xem _MENU_ mục",
                    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                    "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Tìm:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Đầu",
                        "sPrevious": "Trước",
                        "sNext":     "Tiếp",
                        "sLast":     "Cuối"
                    }
            }
        });
	})
</script>
<!-- <script type="text/javascript">
    $(document).ready(function () {
    const timeout = 600000;  // 900000 ms = 15 minutes
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        clearTimeout(idleTimer);

        idleTimer = setTimeout(function () {
            document.getElementById('logout-form').submit();
        }, timeout);
    });
    $("body").trigger("mousemove");
});
</script> -->
<!-- delete -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#check_all').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".checkbox").prop('checked', true);  
         } else {  
            $(".checkbox").prop('checked',false);  
         }  
        });
         $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });
         //delete semester
        $('.delete-all-sem').on('click', function(e) {
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  
            if(idsArr.length <=0)  
            {  
                alert("Bạn chưa chọn dự liệu muốn xóa.");  
            }  else {  
                if(confirm("Bạn có chắc muốn xóa các dữ liệu này?")){  
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: "{{ route('semester.multiple-delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Hãy xóa các lớp thuộc kì học này trước!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }  
            }  
        });
        

                 //delete class
        $('.delete-all-class').on('click', function(e) {
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  
            if(idsArr.length <=0)  
            {  
                alert("Bạn chưa chọn dự liệu muốn xóa.");  
            }  else {  
                if(confirm("Bạn có chắc muốn xóa các dữ liệu này?")){  
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: "{{ route('class.multiple-delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Hãy xóa các học sinh trong lớp trước!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }  
            }  
        }); 
        
                 //delete student
        $('.delete-all-student').on('click', function(e) {
            var idsArr = [];
            var idClass = $(this).attr('data-idclass');
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  
            if(idsArr.length <=0)  
            {  
                alert("Bạn chưa chọn dự liệu muốn xóa.");  
            }  else {  
                if(confirm("Bạn có chắc muốn xóa các dữ liệu này?")){  
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: "{{ route('student.multiple-delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds+'idClasses='+idClass,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Dữ liệu đã có liên kết, hãy xóa các liên kết trước!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }  
            }  
        }); 
    //loc

        $('.roleName_dropdown').click(function(event) {
            /* Act on the event */
            var roleName = $(this).text().toUpperCase();
            if(roleName != 'HIỂN THỊ TẤT CẢ'){
                $('#myTable tr').filter(function(index) {
                    $(this).toggle($(this).text().toUpperCase().indexOf(roleName)>-1);
                });
            }
            else{
                $('#myTable tr').filter(function(index) {
                    $(this).toggle($(this).text().toUpperCase().indexOf(roleName)!=0);
                });
            }
        });  
    });

     //delete subject
        $('.delete-all-subject').on('click', function(e) {
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  
            if(idsArr.length <=0)  
            {  
                alert("Bạn chưa chọn dự liệu muốn xóa.");  
            }  else {  
                if(confirm("Bạn có chắc muốn xóa các dữ liệu này (Các dữ liệu liên quan sẽ bị xóa!)?")){  
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: "{{ route('subject.multiple-delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+strIds,
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkbox:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else {
                                alert('Dữ liệu đã có liên kết, hãy xóa các liên kết trước!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }  
            }  
        });
    

</script>
<script type="text/javascript">
    var url1 = "{{ url('/admin/showlophoc') }}";
    var url2 = "{{ url('/admin/showmonhoc') }}";
    $("select[name='grade']").change(function(){
        var grade_id = $(this).val();
        var sem_id = $("select[name='semester']").val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url1,
            method: 'POST',
            data: {
                grade_id: grade_id,
                sem_id: sem_id,
                _token: token
            },
            success: function(data) {
                $("select[name='classes'").html('');
                $.each(data, function(key, value){
                    $("select[name='classes']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
        $.ajax({
            url: url2,
            method: 'POST',
            data: {
                grade_id: grade_id,
                sem_id: sem_id,
                _token: token
            },
            success: function(data) {
                $("select[name='subject'").html('');
                $.each(data, function(key, value){
                    $("select[name='subject']").append(
                        "<option value=" + value.id + ">" + value.name + "</option>"
                    );
                });
            }
        });
    }); 
</script>
<script type="text/javascript">
    $(document).ready(function(){
 
        $(".check").on('click',function(){
            var count1 = 0;
            var count2 = 0;
            var sum1 = 0;
            var sum2 = 0;
            var sum3 = 0;
            var total = 0;
            $(".hk").each(function(){
                if($(this).val() !== ""){
                    sum3= parseFloat($(this).val());
                }else{
                    sum3=0;
                }
            });
            $(".tx").each(function(){
                if($(this).val() !== ""){
                    count1++;
                    sum1 += parseFloat($(this).val());
                }
            });
            $(".dk").each(function(){
                if($(this).val() !== ""){
                    count2++;
                    sum2 += parseFloat($(this).val());
                }
            });
             total = (sum1 + 2*sum2 +3*sum3)/(count1 + 2*count2 + 3);
            $("#result1").val(total.toFixed(1));
            $("#result2").html(total.toFixed(1));
        });

        $(".tx").on('keyup',function(){
            $(".check").prop('checked',false); 
        });
        $(".dk").on('keyup',function(){
            $(".check").prop('checked',false); 
        });
        $(".hk").on('keyup',function(){
            $(".check").prop('checked',false); 
        });
    });
    
</script>
