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
                {data: 'orderNumber'},
                {data: 'user'},
                {data: 'semester'},
                {data: 'class'},
                {data: 'course'},
                {data: 'weeks'},
                {data: 'recordName', className: 'w-auto'},
                {data: 'createdAt'},
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
        /*DataTable Clear and Destroy*/
        $('[name="attendance-record-add-datatable"] tbody').html(' ');
        $('[name="attendance-record-add-datatable"]').dataTable().fnClearTable();
        $('[name="attendance-record-add-datatable"]').dataTable().fnDraw();
        $('[name="attendance-record-add-datatable"]').dataTable().fnDestroy();
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
            'data': {
                userId: {{Auth::user()->id}}
            },
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
        let studentList = {}, weekList = {}, dayList = {}, control = false, allInputEmptyControl = false;
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
            if ($('[name="recordId"]').val().length == 0) {
                if (this.value.length == 0 && !control) control = true;
                if (this.value.length > 0) {
                    allInputEmptyControl = true;
                }
            }
            weekList = {};
            dayList = {};
        });
        /**All Input Empty Control*/
        if ($('[name="recordId"]').val().length == 0) {
            if (!allInputEmptyControl) {
                Swal.fire({
                    title: "Tüm girdiler boş",
                    text: "Tüm girdiler boş olamaz",
                    icon: "info",
                    showCancelButton: false,
                    confirmButtonText: "<i class='fas fa-check fa-2x text-white'></i>"
                });
                return;
            }
        }
        /*End*/
        let url;
        if ($('[name="recordId"]').val().length > 0) {
            url = '{{url('admin/attendance_record/update')}}';
        } else {
            url = '{{url('admin/attendance_record/create')}}';
        }
        if (control) {
            Swal.fire({
                title: "Are you sure?",
                text: "Girmediğiniz Alanlar 0 olarak kayıt edilecektir.",
                icon: "info",
                showCancelButton: true,
                cancelButtonText: "@lang('body.cancel')",
                confirmButtonText: "@lang('body.save')"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        'url': url,
                        'type': 'POST',
                        'dataType': 'JSON',
                        'data': {
                            'recordId': $('[name="recordId"]').val().length > 0 ? $('[name="recordId"]').val() : 0,
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
                }
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': url,
                'type': 'POST',
                'dataType': 'JSON',
                'data': {
                    'recordId': $('[name="recordId"]').val().length > 0 ? $('[name="recordId"]').val() : 0,
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
        }

    });

    function edit_attendance_record(id) {

        $('[name="attendance-record-add-btn"]').trigger('click');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url("admin/attendance_record/get")}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                recordId: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    let weeks = [], classes = [], semesters = [];
                    for (let i = 0; i < data.length; i++) {
                        classes.push(data[i].class_id + '-' + data[i].course_id);
                        semesters.push(data[i].semester_id);
                        weeks.push(data[i].weeks);
                    }
                    $('[name="class"]').val(classes);
                    $('[name="semester"]').val(semesters);
                    $('[name="week"]').val(weeks);

                    $('[name="class"]').selectpicker('refresh');
                    $('[name="semester"]').selectpicker('refresh');
                    $('[name="week"]').selectpicker('refresh');
                    $('[name="recordId"]').val(id);
                    $('[name="search-btn"]').trigger('click');

                    getAttendanceRecordInputs(id);

                }
            }, error: function (data) {

            }
        });
    }

    /**Get Attendance Record Inputs*/

    function getAttendanceRecordInputs(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url("admin/attendance_record/getList")}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                recordId: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    data.forEach(function (item) {
                        $('[name="' + item.student_id + '-' + $('[name="class"]').val().split('-')[0] + '-' + $('[name="class"]').val().split('-')[1] + '-' + item.week + '-' + item.day + '"]').val(parseInt(item.input)).trigger('mouseup');
                        $('[name="' + item.student_id + '-' + $('[name="class"]').val().split('-')[0] + '-' + $('[name="class"]').val().split('-')[1] + '-' + item.week + '-' + item.day + '"]').removeClass('border-primary');
                        $('[name="' + item.student_id + '-' + $('[name="class"]').val().split('-')[0] + '-' + $('[name="class"]').val().split('-')[1] + '-' + item.week + '-' + item.day + '"]').addClass('border-success');
                    });
                    $('[name="attendance-record-add-datatable"] tbody input').each(function () {
                        if (this.value.length == 0) {
                            this.classList.remove('border-primary');
                            this.classList.add('border-secondary');
                            this.value = 0;
                        }
                    });
                }
            }, error: function (data) {

            }
        });
    }

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
                        Swal.fire({
                            title: "@lang('body.deleting_now')",
                            timer: 5000,
                            onOpen: function () {
                                Swal.showLoading()
                            }
                        }).then(function (result) {
                            if (result.dismiss === "timer") {
                                console.log("I was closed by the timer")
                            }
                        });
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
