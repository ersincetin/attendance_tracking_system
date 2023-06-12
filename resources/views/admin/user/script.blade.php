<script type="application/javascript">
    /**DataTable Function*/
    let userDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        userDataTable = $('[name="users_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/user/dataTable")}}",
                'data': function (data) {
                    data.userType = $('[name="users_datatable"]').attr('data-label')
                },
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber'},
                {data: 'roleName'},
                {data: 'className'},
                {data: 'username'},
                {data: 'fullname'},
                {data: 'email'},
                {data: 'status'},
                {data: 'createdAt'},
                {
                    data: 'edit',
                    className: 'text-right',
                    nowrap: 'nowrap',
                    orderable: false,
                }
            ]
        });
        switch ($('[name="users_datatable"]').attr('data-label')) {
            case 'teacher':
                userDataTable.column(1).visible(false);
                userDataTable.column(2).visible(false);
                break;
            case 'student-affairs':
                userDataTable.column(1).visible(false);
                userDataTable.column(2).visible(false);
                break;
            case 'student':
                userDataTable.column(1).visible(false);
                userDataTable.column(2).visible(true);
                break;
            default:
                userDataTable.column(1).visible(true);
                userDataTable.column(2).visible(false);
        }

        setRequiredDangerText('user-form');
    });

    /**User Add Model Click*/
    $(document).on('click', '[name="user-add-btn"]', function () {
        $('[name="user-form"]').trigger("reset");
        $('[name="status_action"]').text('passive');
        $('[name="userId"]').removeAttr('value');
        $('[data-action="cancel"]').trigger('click');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        setModalTitle("add");
    });

    /**User Edit Function*/
    function edit_user(id) {
        /**User Edit Model show*/
        $('[name="user-form"]').trigger("reset");
        $('[data-action="cancel"]').trigger('click');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        setModalTitle("edit");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/user/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="userId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="status_action"]').text(data.status ? 'active' : 'passive');
                    $('[name="userType"]').val(data.role_id);
                    $('[name="sex"]').val(data.sex);
                    $('[name="username"]').val(data.username);
                    $('[name="identityNumber"]').val(data.identity_number);
                    $('[name="firstname"]').val(data.firstname);
                    $('[name="secondName"]').val(data.second_name);
                    $('[name="lastname"]').val(data.lastname);
                    $('[name="email"]').val(data.email);
                    if (data.photo_url != null) $('.image-input-wrapper').css('background-image', 'url(' + '{{asset("media/photos/users/")}}' + '/' + data.photo_url + ')');
                    $('[name="password"]').val(data.password);
                    $('[name="re-password"]').val(data.password);
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {
        /*Form Validation */
        if (!formValidate('user-form')) return;

        let url;
        if ($('[name="userId"]').val().length > 0) {
            url = '{{url('admin/user/update')}}';
        } else {
            url = '{{url('admin/user/create')}}';
        }

        /**Form Data Create*/
        let formData = new FormData();
        let file = $('[name="profile_avatar"]')[0].files;
        if (file.length > 0) formData.append('file', file[0]);
        formData.append('userId', $('[name="userId"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        formData.append('userType', $('[name="userType"]').val());
        if ($('[name="classId"]').val() != undefined) formData.append('classId', $('[name="classId"]').val());
        formData.append('sex', $('[name="sex"]').val());
        formData.append('username', $('[name="username"]').val());
        formData.append('identityNumber', $('[name="identityNumber"]').val());
        formData.append('firstname', $('[name="firstname"]').val());
        formData.append('secondName', $('[name="secondName"]').val());
        formData.append('lastname', $('[name="lastname"]').val());
        formData.append('email', $('[name="email"]').val());
        if ($('[name="password"]').val() != undefined) formData.append('password', $('[name="password"]').val() != undefined);

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
                    $('#user_modal').modal('hide');
                    if ($('[name="userId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.user_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.user_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="userId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.user_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.user_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**User Delete Function*/
    function delete_user(id) {
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
                    'url': '{{url('admin/user/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        userId: id
                    }, beforeSend: function () {
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

    var avatar3 = new KTImageInput('kt_image_3');

    /**DataTable reload function*/
    function reloadDataTable() {
        userDataTable.ajax.reload(null, false); //reload datatable ajax
    }

    /**Status Change Event*/
    $(document).on('change', '[name="status"]', function () {
        $('[name="status_action"]').text($(this).prop('checked') ? 'active' : 'passive');
    });

    function setModalTitle(type) {
        type = type == 'add' ? 'Add' : 'Edit';
        switch ($('[name="users_datatable"]').attr('data-label')) {
            case 'user':
                $('#user_modal').find('.modal-title').text("@lang('body.user_add')").end().modal('show');
                break;
            case 'teacher':
                $('#user_modal').find('.modal-title').text("@lang('body.teacher_add')").end().modal('show');
                break;
            case 'student-affairs':
                $('#user_modal').find('.modal-title').text("@lang('body.student_affairs_add')").end().modal('show');
                break;
        }
    }

</script>
