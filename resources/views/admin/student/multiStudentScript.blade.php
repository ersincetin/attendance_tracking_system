<script>
    let count = 0;
    let rowItem = 0;
    let datatable;
    $(document).ready(function () {
        $.fn.DataTable.ext.errMode = 'throw';
        datatable = $('[name="multi-student-add-table"]').DataTable({
            'responsive': true,
            'scrollX': true,
            'paging': false,
            'searching': false,
            'info': false,
        });
    });
    $(document).on('click', '[name="row-add"]', function () {
        count = $('[name="multi-student-add-table"] tbody tr').length;
        $('[name="multi-student-add-table"] tbody').html($('[name="multi-student-add-table"] tbody').html() + '<tr name="row-item-' + (count + 1) + '">\n' +
            '                                <td name="row-count">' + (count + 1) + '</td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0 row">\n' +
            '                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">\n' +
            '                                            <select class="form-control form-control-sm form-control-solid" name="class" required>\n' +
            '                                                <option value="0">@lang("body.choose")</option>\n' +
            '                                                <option value="6">M</option>\n' +
            '                                                <option value="7">L</option>\n' +
            '                                            </select>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0 row">\n' +
            '                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">\n' +
            '                                            <select class="form-control form-control-sm form-control-solid" name="sex" required>\n' +
            '                                                <option value="0">@lang("body.choose")</option>\n' +
            '                                                <option value="M">@lang("body.male")</option>\n' +
            '                                                <option value="F">@lang("body.female")</option>\n' +
            '                                            </select>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0">\n' +
            '                                        <input type="text" class="form-control form-control-sm form-control-solid"\n' +
            '                                               name="identityNumber" required\n' +
            '                                               placeholder="Enter @lang("body.identity_number")"/>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0">\n' +
            '                                        <input type="text" class="form-control form-control-sm form-control-solid"\n' +
            '                                               name="firstname" required\n' +
            '                                               placeholder="Enter @lang("body.firstname")"/>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0">\n' +
            '                                        <input type="text" class="form-control form-control-sm form-control-solid"\n' +
            '                                               name="secondName"\n' +
            '                                               placeholder="Enter @lang("body.second_name")"/>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0">\n' +
            '                                        <input type="text" class="form-control form-control-sm form-control-solid"\n' +
            '                                               name="lastname" required\n' +
            '                                               placeholder="Enter @lang("body.lastname")"/>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                                <td>\n' +
            '                                    <div class="form-group mb-0 pb-0">\n' +
            '                                        <a href="#" class="btn btn-sm btn-icon" title="@lang('body.delete')">\n' +
            '                                            <i class="fas fa fa-trash text-danger" data-value="item-' + (count + 1) + '"></i>\n' +
            '                                        </a>\n' +
            '                                    </div>\n' +
            '                                </td>\n' +
            '                            </tr>');
    });
    $(document).on('click', '.fa-trash', function () {
        rowItem = $('[name="row-count"]');
        if (rowItem.length > 1) {
            $('[name="row-' + $(this).attr('data-value') + '"]').remove();
            count--;
            for (let i = 0; i < rowItem.length; i++) {
                rowItem[i].innerHTML = i;
            }
        }
    });
    $(document).on('click', '[name="multi-save-btn"]', function () {
        let student = {};
        let studentList = [];

        /**Validation Control*/
        //if (!formValidate('multi-user-form')) return;

        /*** Multi Get Form Data's **/
        $('[name="multi-user-form"]').serializeArray().forEach(function (key) {
            if (student[key.name] != undefined) {
                studentList.push(Object.assign({}, student));
                student = {};
            }
            student[key.name] = key.value;
        });
        if (Object.keys(student).length > 0) studentList.push(Object.assign({}, student));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/student/create')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                'students': Object.assign({}, studentList)
            },
            success: function (data) {
                if (undefined != data) {
                    $('#user_modal_xl').modal('hide');
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
</script>
