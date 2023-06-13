<script>
    function assigning_class(id) {
        $('[name="assigning-class-form"]').trigger('reset');
        $('[name="assigning-class-form"] input[name="userId"]').val(id);
        $('[name="assigning-class-modal"]').find('.modal-title').text("@lang('body.assigning_class')").end().modal('show');
        getClassList(id);
    }

    function getClassList(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/class/getList')}}',
            'type': 'POST',
            'dataType': 'JSON',
            beforeSend: function () {
                $('[name="assigning-class-inputs"]').html();
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    let htmlField = '';
                    data.forEach(function (value, key) {
                        htmlField += '<label class="col-3 col-form-label">' + value.name + '</label>\n' +
                            '                            <div class="col-3">\n' +
                            '                               <span class="switch switch-outline switch-icon switch-info">\n' +
                            '                                <label>\n' +
                            '                                 <input type="checkbox" name="' + value.id + '"/>\n' +
                            '                                 <span></span>\n' +
                            '                                </label>\n' +
                            '                               </span>\n' +
                            '                            </div>';
                    });
                    $('[name="assigning-class-inputs"]').html(htmlField);
                    getAssigningClass(id);
                }
            }, error: function (data) {

            }
        });
    }

    /** Assigning Course Save*/
    $(document).on('click', '[name="assigning-class-save-btn"]', function () {
        let classList = {};
        $('[name="assigning-class-form"] input:checkbox').each(function () {
            if (this.checked) classList[this.name] = 1;
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/user/setAssigningClass')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                'userId': $('[name="assigning-class-form"] input[name="userId"]').val(),
                'classList': classList
            },
            beforeSend: function () {
            },
            success: function (data) {
                if (undefined != data) {
                    setAlert('success', '@lang('alert.assigning_class_update')', '@lang('alert.update_successfully')');
                    $('[name="assigning-class-modal"]').modal('hide');
                    reloadDataTable();
                }
            }, error: function (data) {
                setAlert('error', '@lang('alert.assigning_class_update')', '@lang('alert.update_something_went_wrong')');
            }
        });
    });

    /** Get Assigning Class for Class*/
    function getAssigningClass(id) {
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
                if (undefined != data.assigning_class && null != data.assigning_class) {
                    Object.entries(JSON.parse(data.assigning_class)).forEach(entry => {
                        const [key, value] = entry;
                        $('[name="assigning-class-form"] input:checkbox[name="' + key + '"]').prop('checked',(value == 1 ? true : false));
                    });
                }
            }, error: function (data) {

            }
        });
    }
</script>
