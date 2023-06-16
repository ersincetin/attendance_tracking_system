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
                    let htmlField = '', htmlCheckBox = '';
                    data.forEach(function (value, key) {
                        JSON.parse(value.assigning_course).forEach(function (courseValue, courseKey) {
                            htmlCheckBox += '<div class="col-auto col-form-label m-0 p-0">\n' +
                                '                                    <div class="checkbox-inline">\n' +
                                '                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-info">\n' +
                                '                                            <input type="checkbox" name="' + courseValue.id + '" data-label="student-affairs"\n' +
                                '                                            />\n' +
                                '                                            <span></span>\n' +
                                '                                            ' + courseValue.name + '\n' +
                                '                                        </label>\n' +
                                '                                    </div>\n' +
                                '                                </div>';
                        });
                        htmlField += '<div class="col-6">' +
                            '<label class="col-6 col-form-label">' + value.name + '</label>\n' +
                            '                            <div class="col-6">\n' +
                            '                               <span class="switch switch-outline switch-icon switch-info" data-toggle="collapse" data-target="#multiCollapse-' + value.id + '" aria-expanded="false" aria-controls="multiCollapse-' + value.id + '">\n' +
                            '                                <label>\n' +
                            '                                 <input type="checkbox" name="form-checkbox" id="' + value.id + '"/>\n' +
                            '                                 <span></span>\n' +
                            '                                </label>\n' +
                            '                               </span>\n' +
                            '                            </div>' +
                            '' +
                            '  <div class="col-12">\n' +
                            '    <div class="collapse width" name="multiCollapse-' + value.id + '">\n' +
                            '      <div class="card card-body m-1 p-1 border border-1 border-info">\n' +
                            htmlCheckBox +
                            '      </div>\n' +
                            '    </div>\n' +
                            '  </div>' +
                            '</div>';

                        htmlCheckBox = '';
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
        let classList = {}, courseList = [];
        $('[name="assigning-class-form"] input:checkbox[name="form-checkbox"]').each(function () {
            if (this.checked) {
                courseList = [];
                $('[name="assigning-class-form"] [name="multiCollapse-' + this.id + '"] input:checkbox').each(function () {
                    if (this.checked) courseList.push(this.name);
                });
                classList[this.id] = courseList;
                console.log(classList);

            }
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
                        $('[name="assigning-class-form"] input:checkbox[id="' + key + '"]').prop('checked', 1);
                        $('[name="assigning-class-form"] [name="multiCollapse-' + key + '"]').addClass('show');
                        value.forEach(courseEntry => {
                            const [courseKey] = courseEntry;
                            $('[name="assigning-class-form"] [name="multiCollapse-' + key + '"] input:checkbox[name=' + courseKey + ']').prop('checked', 1);
                        });
                    });
                }
            }, error: function (data) {

            }
        });
    }

    /**Collapse Open-Close*/
    $(document).on('change', '[name="assigning-class-form"] input:checkbox[name="form-checkbox"]', function () {
        if (this.checked) {
            $('[name="assigning-class-form"] [name="multiCollapse-' + this.id + '"]').addClass('show');
        } else {
            $('[name="assigning-class-form"] [name="multiCollapse-' + this.id + '"]').removeClass('show');
        }
    });
</script>
