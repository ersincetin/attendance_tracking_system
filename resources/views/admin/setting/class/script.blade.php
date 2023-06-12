<script>
    let classDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        classDataTable = $('[name="class_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/settings/class/dataTable")}}",
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber'},
                {data: 'status'},
                {data: 'className'},
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

    $(document).on('click', '[name="class-add-btn"]', function () {
        $('[name="class-form"]').trigger("reset");
        $('[name="classId"]').removeAttr('value');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="class-modal"]').find('.modal-title').text("@lang('body.class_add')").end().modal('show');
    });

    /** Class Edit Function*/
    function edit_class(id) {
        $('[name="class-form"]').trigger("reset");
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/class/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="classId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="className"]').val(data.name);

                    $('[name="class-modal"]').find('.modal-title').text("@lang('body.class_edit')").end().modal('show');
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {

        let url;
        if ($('[name="classId"]').val().length > 0) {
            url = '{{url('admin/settings/class/update')}}';
        } else {
            url = '{{url('admin/settings/class/create')}}';
        }


        let formData = new FormData();
        formData.append('classId', $('[name="classId"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        formData.append('className', $('[name="className"]').val());

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
                    $('[name="class-modal"]').modal('hide');
                    if ($('[name="classId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.class_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.class_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="classId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.class_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.class_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**Role Delete Function*/
    function delete_class(id) {
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
                    'url': '{{url('admin/settings/class/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        classId: id
                    }, beforeSend: function () {
                    },
                    success: function (data) {
                        if (undefined != data && 1 == data) {
                            setAlert('success', '@lang('alert.class_delete')', '@lang('alert.delete_successfully').');
                            reloadDataTable();
                        }
                    }, error: function (data) {
                        setAlert('error', '@lang('alert.class.delete')', '@lang('alert.delete_something_went_wrong')');
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
        classDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
