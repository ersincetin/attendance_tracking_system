<script>
    let semesterDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        semesterDataTable = $('[name="semester_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/settings/semester/dataTable")}}",
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber',className:'w-5px'},
                {data: 'status',className:'w-5px'},
                {data: 'semesterName',className:'w-auto'},
                {data: 'createdAt',className:'w-125px'},
                {
                    data: 'edit',
                    className: 'text-right',
                    nowrap: 'nowrap',
                    orderable: false,
                }
            ]
        });
    });

    $(document).on('click', '[name="semester-add-btn"]', function () {
        $('[name="semester-form"]').trigger("reset");
        $('[name="semesterId"]').removeAttr('value');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="semester-modal"]').find('.modal-title').text("@lang('body.semester_add')").end().modal('show');
    });

    /** semester Edit Function*/
    function edit_semester(id) {
        $('[name="semester-form"]').trigger("reset");
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/semester/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="semesterId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="semesterName"]').val(data.name);

                    $('[name="semester-modal"]').find('.modal-title').text("@lang('body.semester_edit')").end().modal('show');
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {

        let url;
        if ($('[name="semesterId"]').val().length > 0) {
            url = '{{url('admin/settings/semester/update')}}';
        } else {
            url = '{{url('admin/settings/semester/create')}}';
        }

        let formData = new FormData();
        formData.append('semesterId', $('[name="semesterId"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        formData.append('semesterName', $('[name="semesterName"]').val());

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
                    $('[name="semester-modal"]').modal('hide');
                    if ($('[name="semesterId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.semester_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.semester_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="semesterId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.semester_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.semester_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**Role Delete Function*/
    function delete_semester(id) {
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
                    'url': '{{url('admin/settings/semester/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        semesterId: id
                    }, beforeSend: function () {
                    },
                    success: function (data) {
                        if (undefined != data && 1 == data) {
                            setAlert('success', '@lang('alert.semester_delete')', '@lang('alert.delete_successfully').');
                            reloadDataTable();
                        }
                    }, error: function (data) {
                        setAlert('error', '@lang('alert.semester.delete')', '@lang('alert.delete_something_went_wrong')');
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
        semesterDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
