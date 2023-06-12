<script>
    let roleDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        roleDataTable = $('[name="role_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/settings/role/dataTable")}}",
                'data': function (data) {
                    data.userType = $('[name="role_datatable"]').attr('data-label')
                },
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber'},
                {data: 'status'},
                {data: 'roleName'},
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

    $(document).on('click', '[name="role-add-btn"]', function () {
        $('[name="role-form"]').trigger("reset");
        $('[name="roleId"]').removeAttr('value');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="role-modal"]').find('.modal-title').text("@lang('body.role_add')").end().modal('show');
    });

    /** Role Edit Function*/
    function edit_role(id) {
        $('[name="role-form"]').trigger("reset");
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="role-modal"]').find('.modal-title').text("@lang('body.role_edit')").end().modal('show');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/role/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="roleId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="roleName"]').val(data.name);
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {

        let url;
        if ($('[name="roleId"]').val().length > 0) {
            url = '{{url('admin/settings/role/update')}}';
        } else {
            url = '{{url('admin/settings/role/create')}}';
        }


        let formData = new FormData();
        formData.append('roleId', $('[name="roleId"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        formData.append('roleName', $('[name="roleName"]').val());

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
                    $('[name="role-modal"]').modal('hide');
                    if ($('[name="roleId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.user_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.user_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="roleId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.user_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.user_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**Role Delete Function*/
    function delete_role(id) {
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
                    'url': '{{url('admin/settings/role/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        roleId: id
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

    /**DataTable reload function*/
    function reloadDataTable() {
        roleDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
