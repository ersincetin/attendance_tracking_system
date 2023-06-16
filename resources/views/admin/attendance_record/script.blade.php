<script>
    let attendanceRecordDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        attendanceRecordDataTable = $('[name="attendance_record_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/attendance_record/dataTable")}}",
                'error': function (t) {
                }
            },
            'columns': [
                {data: 'orderNumber', className: 'w-5px'},
                {data: 'user', className: 'w-15px'},
                {data: 'class', className: 'w-15px'},
                {data: 'semester', className: 'w-15px'},
                {data: 'recordName', className: 'w-auto'},
                {data: 'createdAt', className: 'w-125px'},
                {
                    data: 'edit',
                    className: 'text-right',
                    nowrap: 'nowrap',
                    orderable: false,
                }
            ]
        });
    });

    $(document).on('click', '[name="attendance-record-add-btn"]', function () {
        $('[name="attendance-record-form"]').trigger("reset");
        $('[name="recordId"]').removeAttr('value');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="attendance-record-modal"]').find('.modal-title').text("@lang('body.record_add')").end().modal('show');
        getClassAndCourseList();
        getSemesterList();
        getActiveWeekList();
    });

    /**Get Semester List*/
    function getSemesterList() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/semester/getList')}}',
            'type': 'POST',
            'dataType': 'JSON',
            beforeSend: function () {
                $('[name="semester"]').empty();
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    data.forEach(function (value, key) {
                        $('[name="semester"]').append($('<option></option>').val(value.id).html(value.name));
                    });
                    $('[name="semester"]').selectpicker('refresh');
                }
            }, error: function (data) {

            }
        });
    }

    /** Get Week List*/
    function getActiveWeekList() {
        $('[name="week"]').empty();
        [1, 2, 3, 4, 5, 6, 7, 8, 9].forEach(function (value, key) {
            $('[name="week"]').append($('<option></option>').val(value).html(value + '. Week'));
        });
        $('[name="week"]').selectpicker('refresh');
    }

    /**Get Class and Course List*/
    function getClassAndCourseList() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/class/getList')}}',
            'type': 'POST',
            'dataType': 'JSON',
            beforeSend: function () {
                $('[name="class"]').empty();
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    data.forEach(function (value, key) {
                        $('[name="class"]').append($('<optgroup label="' + value.name + '"></optgroup>'));
                        JSON.parse(value.assigning_course).forEach(function (courseValue, courseKey) {
                            $('[name="class"] optgroup[label="' + value.name + '"]').append($('<option data-subtext="' + value.name + '"></option>').val(value.id + '-' + courseValue.id).html(courseValue.name));
                        });
                    });
                    $('[name="class"]').selectpicker('refresh');
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {
        let studentList = {}, weekList = {}, dayList = {};
        $('[name="attendance-record-add-datatable"] tbody input').each(function () {
            if (studentList[this.name.split('-')[0]] == undefined) {
                studentList[this.name.split('-')[0]] = weekList;
            }
            if (studentList[this.name.split('-')[0]][this.name.split('-')[3]] == undefined) {
                studentList[this.name.split('-')[0]][this.name.split('-')[3]] = dayList;
            }
            if (studentList[this.name.split('-')[0]][this.name.split('-')[3]][this.name.split('-')[4]] == undefined) {
                studentList[this.name.split('-')[0]][this.name.split('-')[3]][this.name.split('-')[4]] = this.value.length > 0 ? parseInt(this.value) : 0;
            }
            studentList[this.name.split('-')[0]][this.name.split('-')[3]][this.name.split('-')[4]] = this.value.length > 0 ? parseInt(this.value) : 0;
        });
        console.log(studentList);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/attendance_record/create')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                'classId': $('[name="class"]').val().split('-')[0],
                'courseId': $('[name="class"]').val().split('-')[1],
                'semesterId': $('[name="semester"]').val(),
                'inputs': Object.assign({}, studentList)
            },
            success: function (data) {
                if (undefined != data) {
                    $('[name="attendance-record-modal"]').modal('hide');
                    if ($('[name="recordId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.attendance_record_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.attendance_record_create')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="recordId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.attendance_record_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.attendance_record_create')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**Role Delete Function*/
    function delete_attendance_record(id) {
        Swal.fire({
            title: "Emin misiniz ?",
            text: "Bunu geri alamazsınız",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Evet, sil!",
            cancelButtonText: "Hayır, silme!",
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'url': '{{url('admin/attendance_record/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        recordId: id
                    },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (undefined != data && 1 == data) {
                            setAlert('success', '@lang('alert.attendance_record_delete')', '@lang('alert.delete_successfully').');
                            reloadDataTable();
                        }
                    }, error: function (data) {
                        setAlert('error', '@lang('alert.attendance_record_delete')', '@lang('alert.delete_something_went_wrong')');
                    }, complete: function () {
                    }
                });
            } else if (result.dismiss === "cancel") {
                Swal.fire({
                    icon: "error",
                    title: 'Cancelled',
                    text: "Your imaginary data is safe :)",
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    }

    /**DataTable reload function*/
    function reloadDataTable() {
        attendanceRecordDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
