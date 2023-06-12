<script>
    let lessonDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        lessonDataTable = $('[name="lesson_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/settings/lesson/dataTable")}}",
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber'},
                {data: 'status'},
                {data: 'lessonName'},
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

    $(document).on('click', '[name="lesson-add-btn"]', function () {
        $('[name="lesson-form"]').trigger("reset");
        $('[name="lessonId"]').removeAttr('value');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="lesson-modal"]').find('.modal-title').text("@lang('body.lesson_add')").end().modal('show');
    });

    /** Lesson Edit Function*/
    function edit_lesson(id) {
        $('[name="lesson-form"]').trigger("reset");
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/lesson/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="lessonId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="lessonName"]').val(data.name);

                    $('[name="lesson-modal"]').find('.modal-title').text("@lang('body.lesson_edit')").end().modal('show');
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {

        let url;
        if ($('[name="lessonId"]').val().length > 0) {
            url = '{{url('admin/settings/lesson/update')}}';
        } else {
            url = '{{url('admin/settings/lesson/create')}}';
        }

        let formData = new FormData();
        formData.append('lessonId', $('[name="lessonId"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        formData.append('lessonName', $('[name="lessonName"]').val());

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
                    $('[name="lesson-modal"]').modal('hide');
                    if ($('[name="lessonId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.lesson_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.lesson_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="lessonId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.lesson_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.lesson_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**Role Delete Function*/
    function delete_lesson(id) {
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
                    'url': '{{url('admin/settings/lesson/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        lessonId: id
                    }, beforeSend: function () {
                    },
                    success: function (data) {
                        if (undefined != data && 1 == data) {
                            setAlert('success', '@lang('alert.lesson_delete')', '@lang('alert.delete_successfully').');
                            reloadDataTable();
                        }
                    }, error: function (data) {
                        setAlert('error', '@lang('alert.lesson.delete')', '@lang('alert.delete_something_went_wrong')');
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
        lessonDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
