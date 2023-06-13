<script>
    let courseDataTable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        courseDataTable = $('[name="course_datatable"]').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'POST',
            'responsive': true,
            'scrollX': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{url("admin/settings/course/dataTable")}}",
                'error': function (t) {

                }
            },
            'columns': [
                {data: 'orderNumber',className:'w-5px'},
                {data: 'status',className:'w-5px'},
                {data: 'courseName',className:'w-auto'},
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

    $(document).on('click', '[name="course-add-btn"]', function () {
        $('[name="course-form"]').trigger("reset");
        $('[name="courseId"]').removeAttr('value');
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        $('[name="course-modal"]').find('.modal-title').text("@lang('body.course_add')").end().modal('show');
    });

    /** course Edit Function*/
    function edit_course(id) {
        $('[name="course-form"]').trigger("reset");
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/course/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: id
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="courseId"]').val(data.id);
                    $('[name="status"]').prop("checked", (data.status ? true : false));
                    $('[name="courseName"]').val(data.name);

                    $('[name="course-modal"]').find('.modal-title').text("@lang('body.course_edit')").end().modal('show');
                }
            }, error: function (data) {

            }
        });
    }

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {

        let url;
        if ($('[name="courseId"]').val().length > 0) {
            url = '{{url('admin/settings/course/update')}}';
        } else {
            url = '{{url('admin/settings/course/create')}}';
        }

        let formData = new FormData();
        formData.append('courseId', $('[name="courseId"]').val());
        formData.append('status', $('[name="status"]').is(':checked') ? 1 : 0);
        formData.append('courseName', $('[name="courseName"]').val());

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
                    $('[name="course-modal"]').modal('hide');
                    if ($('[name="courseId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.course_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.course_add')', '@lang('alert.save_successfully')');
                    }
                    reloadDataTable();
                }
            }, error: function (data) {
                if ($('[name="courseId"]').val().length > 0) {
                    setAlert('error', '@lang('alert.course_update')', '@lang('alert.update_something_went_wrong')');
                } else {
                    setAlert('error', '@lang('alert.course_add')', '@lang('alert.save_something_went_wrong')');
                }
            }
        });
    });

    /**Role Delete Function*/
    function delete_course(id) {
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
                    'url': '{{url('admin/settings/course/delete')}}',
                    'type': 'POST',
                    'dataType': 'JSON',
                    'data': {
                        courseId: id
                    }, beforeSend: function () {
                    },
                    success: function (data) {
                        if (undefined != data && 1 == data) {
                            setAlert('success', '@lang('alert.course_delete')', '@lang('alert.delete_successfully').');
                            reloadDataTable();
                        }
                    }, error: function (data) {
                        setAlert('error', '@lang('alert.course.delete')', '@lang('alert.delete_something_went_wrong')');
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
        courseDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>
