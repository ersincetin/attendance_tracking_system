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
        $('#student_modal').find('.modal-title').text("@lang('body.student_add')").end().modal('show');
    });

    /**Status Change Event*/
    $(document).on('change', '[name="status"]', function () {
        $('[name="status_action"]').text($(this).prop('checked') ? 'active' : 'passive');
    });

    $(document).on('click', '[name="user-add-multi-btn"]', function () {
        $('#user_modal_xl').find('.modal-title').text("Çoklu Öğrenci Ekleme").end().modal('show');
    });

    /**User Edit Function*/
    function edit_student(id) {
        /**User Edit Model show*/
        $('[name="student-form"]').trigger("reset");
        $('[data-action="cancel"]').trigger('click');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
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
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {
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
                        setAlert('success', '@lang('alert.user_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.user_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="studentId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.user_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.user_add')', '@lang('alert.save_something_went_wrong')');
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

    /**Form Validate Function*/
    function formValidate(formTagName) {
        let formInput = $('[name="' + formTagName + '"]')[0];
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');

        /** Required Control */
        for (let i = 0; i < formInput.length; i++) {
            if ((formInput[i].type == 'text' || formInput[i].type == 'email')) {
                if (formInput[i].value.length > 0 && formInput[i].required) {
                    formInput[i].classList.add('is-valid');
                    /** Identity Number Check*/
                    if (formInput[i].name == 'identityNumber')
                        if (!identityNumberControl(formInput[i].value)) {
                            setAlert('error', 'Failed', 'Identity Number Failed');
                            formInput[i].classList.add('is-invalid');
                        }
                } else {
                    if (formInput[i].required) formInput[i].classList.add('is-invalid');
                }
            } else if (formInput[i].type == 'select-one') {
                if (formInput[i].value > 0 || formInput[i].value != 0) {
                    formInput[i].classList.add('is-valid');
                } else {
                    formInput[i].classList.add('is-invalid');
                }
            }
        }
    }

    function setRequiredDangerText(formTagName) {
        let formInput = $('[name="' + formTagName + '"]')[0];
        for (let i = 0; i < formInput.length; i++) {
            if ((formInput[i].type == 'text' || formInput[i].type == 'email')) {
                if (formInput[i].required) $('[name="' + formInput[i].getAttribute('name') + '-label"]').html($('[name="' + formInput[i].getAttribute('name') + '-label"]').html() + ' <span class="text-danger">*</span>');
            }
        }
    }

    /**Identity Number Control Function*/
    function identityNumberControl(identityNumber) {

        if (identityNumber.length != 11) return false;
        if (isNaN(identityNumber)) return false;
        if (identityNumber[0] == 0) return false;

        let odd = 0, even = 0, result = 0, digitTotal = 0;
        let errorList = [11111111110, 22222222220, 33333333330, 44444444440, 55555555550, 66666666660, 7777777770, 88888888880, 99999999990];
        odd = parseInt(identityNumber[0]) + parseInt(identityNumber[2]) + parseInt(identityNumber[4]) + parseInt(identityNumber[6]) + parseInt(identityNumber[8]);
        even = parseInt(identityNumber[1]) + parseInt(identityNumber[3]) + parseInt(identityNumber[5]) + parseInt(identityNumber[7]);

        odd = odd * 7;
        result = Math.abs(odd - even);
        if (result % 10 != identityNumber[9]) return false;

        for (let i = 0; i < 10; i++) {
            digitTotal += parseInt(identityNumber[i]);
        }
        if (digitTotal % 10 != identityNumber[10]) return false;

        if (errorList.toString().indexOf(identityNumber) != -1) return false;

        return true;
    }

    /**DataTable reload function*/
    function reloadDataTable() {
        studentDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
