<script>
    let attendanceRecordInputDataTable;
    $(document).on('click', '[name="search-btn"]', function () {
        $.fn.DataTable.ext.errMode = 'throw';
        attendanceRecordInputDataTable = $('[name="attendance-record-add-datatable"]').DataTable({
            processing: true,
            serverSide: true,
            serverMethod: 'POST',
            responsive: true,
            scrollX: true,
            paging: false,
            searching: false,
            ajax: {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/attendance_record/getFilteredClassDataTable")}}",
                'data': {
                    classId: $('[name="class"]').val().split('-')[0],
                    courseId: $('[name="class"]').val().split('-')[1],
                    semesterId: $('[name="semester"]').val(),
                    week: $('[name="week"]').val(),
                },
                'error': function (t) {
                }
            },
            columns: [
                {data: 'orderNumber', className: 'w-5px'},
                {data: 'student', className: 'w-150px', orderable: false,},
                {
                    data: 'edit',
                    className: 'text-left w-auto',
                    nowrap: 'display nowrap',
                    orderable: false,
                }
            ]
        });
    });
</script>
