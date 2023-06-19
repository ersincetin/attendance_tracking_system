<script>
    let studentDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        studentDataTable = $('[name="student_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/student/dataTable")}}",
                'data': function (data) {
                    data.userType = $('[name="student_datatable"]').attr('data-label')
                },
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber'},
                {data: 'status'},
                {data: 'className'},
                {data: 'fullName'},
                {data: 'email'},
                {data: 'createdAt'},
                {
                    data: 'edit',
                    className: 'text-right',
                    nowrap: 'nowrap',
                    orderable: false,
                }
            ]
        });
        setRequiredDangerText('student-form');
    });

    /**User Add Model Click*/
    $(document).on('click', '[name="student-add-btn"]', function () {
        $('[name="student-form"]').trigger("reset");
        $('[name="status_action"]').text('passive');
        $('[name="studentId"]').removeAttr('value');
        $('[data-action="cancel"]').trigger('click');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        getClassList();
        $('#student_modal').find('.modal-title').text("@lang('body.student_add')").end().modal('show');
    });

    /**Status Change Event*/
    $(document).on('change', '[name="status"]', function () {
        $('[name="status_action"]').text($(this).prop('checked') ? 'active' : 'passive');
    });

    $(document).on('click', '[name="user-add-multi-btn"]', function () {
        $('#user_modal_xl').find('.modal-title').text("Çoklu Öğrenci Ekleme").end().modal('show');
        $('[name="multi-student-add-table"] tbody').html('');
        count = 0;
        $('[name="row-add"]').trigger('click');
        getClassList();
    });

    /**User Edit Function*/
    function edit_student(id) {
        /**User Edit Model show*/
        $('[name="student-form"]').trigger("reset");
        $('[data-action="cancel"]').trigger('click');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        getClassList();
        $('#student_modal').find('.modal-title').text("@lang('body.student_edit')").end().modal('show');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/student/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="studentId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="status_action"]').text(data.status ? 'active' : 'passive');
                    $('[name="sex"]').val(data.sex);
                    $('[name="identityNumber"]').val(data.identity_number);
                    $('[name="firstname"]').val(data.firstname);
                    $('[name="secondName"]').val(data.second_name);
                    $('[name="lastname"]').val(data.lastname);
                    $('[name="email"]').val(data.email);
                    if (data.photo_url != null) $('.image-input-wrapper').css('background-image', 'url(' + '{{asset("media/photos/users/")}}' + '/' + data.photo_url + ')');
                    $('[name="class"]').val(data.class_id).change();
                    $('[name="class"]').selectpicker('refresh');
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {
        /*Form Validation */
        if (!formValidate('student-form')) return;

        let url;
        if ($('[name="studentId"]').val().length > 0) {
            url = '{{url('admin/student/update')}}';
        } else {
            url = '{{url('admin/student/create')}}';
        }

        /**Form Data Create*/
        let formData = new FormData();
        let file = $('[name="profile_avatar"]')[0].files;
        if (file.length > 0) formData.append('file', file[0]);
        formData.append('studentId', $('[name="studentId"]').val());
        formData.append('classId', $('[name="class"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        if ($('[name="classId"]').val() != undefined) formData.append('classId', $('[name="classId"]').val());
        formData.append('sex', $('[name="sex"]').val());
        formData.append('identityNumber', $('[name="identityNumber"]').val());
        formData.append('firstname', $('[name="firstname"]').val());
        formData.append('secondName', $('[name="secondName"]').val());
        formData.append('lastname', $('[name="lastname"]').val());
        formData.append('email', $('[name="email"]').val());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': url,
            'type': 'POST',
            'contentType': false,
            'processData': false,
            'data': formData,
            success: function (data) {
                if (undefined != data) {
                    $('#student_modal').modal('hide');
                    if ($('[name="studentId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.student_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.student_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="studentId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.student_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.student_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**User Delete Function*/
    function delete_student(id) {
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
                    'url': '{{url('admin/student/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        studentId: id
                    },
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (undefined != data && 1 == data) {
                            setAlert('success', '@lang('alert.user_delete')', '@lang('alert.delete_successfully').');
                            reloadDataTable();
                        }
                    }, error: function (data) {
                        setAlert('error', '@lang('alert.user.delete')', '@lang('alert.delete_something_went_wrong')');
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

    function getClassList() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/class/getList')}}',
            'type': 'POST',
            'dataType': 'JSON',
            beforeSend: function () {
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="class"]').empty();
                    data.forEach(function (value, key) {
                        $('[name="class"]').append($('<option></option>').val(value.id).html(value.name));
                    });
                    $('[name="class"]').selectpicker('refresh');

                    /**Multi Student Add modal for*/
                    $('[name="multi-class"]').each(function () {
                        $('#' + this.id).empty();
                        $(this).append($('<option></option>').val(0).html("@lang("body.choose")"));
                        for (let i = 0; i < data.length; i++) {
                            $(this).append($('<option></option>').val(data[i].id).html(data[i].name));
                        }
                    });
                }
            }, error: function (data) {

            }
        });
    }

    /**DataTable reload function*/
    function reloadDataTable() {
        studentDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
