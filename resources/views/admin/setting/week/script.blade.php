<script>
    $('[name="start_datetimepicker"]').datetimepicker({
        locale: 'tr', format: 'L'
    });
    $('[name="end_datetimepicker"]').datetimepicker({
        locale: 'tr',
        format: 'L',
        useCurrent: false
    });

    $('[name="start_datetimepicker"]').on('change.datetimepicker', function (e) {
        $('[name="end_datetimepicker"]').datetimepicker('minDate', e.date);
    });
    $('[name="end_datetimepicker"]').on('change.datetimepicker', function (e) {
        $('[name="start_datetimepicker"]').datetimepicker('maxDate', e.date);
    });

    $(document).on('click', '[name="calculate-btn"]', function () {
        /**Date Input Empty Control*/
        if ($('[name="start_datetimepicker"] input').val().length == 0 || $('[name="end_datetimepicker"] input').val().length == 0) {
            if ($('.is-invalid').length > 0) $('.is-invalid').removeClass('is-invalid');
            if ($('[name="start_datetimepicker"] input').val().length == 0) $('[name="start_datetimepicker"] input').addClass('is-invalid');
            if ($('[name="end_datetimepicker"] input').val().length == 0) $('[name="end_datetimepicker"] input').addClass('is-invalid');
            setAlert('warning', '@lang('alert.input_empty')', '');
            if ($('.is-invalid').length > 0) return
        }

        let start_date = new Date(YYYY_MM_DD($('[name="start_datetimepicker"] input').val()));
        let end_date = new Date(YYYY_MM_DD($('[name="end_datetimepicker"] input').val()));

        let diff_week = Math.abs(Math.round(((end_date.getTime() - start_date.getTime()) / 1000) / (60 * 60 * 24 * 7)));

        let html = '';
        for (let i = 1; i <= diff_week; i++) {
            html += '<div class="col-3 col-form-label border border-1 border-primary m-1">\n' +
                '                                    <div class="checkbox-inline">\n' +
                '                                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary">\n' +
                '                                            <input type="checkbox" name="' + i + '" data-label="' + i + '"/>\n' +
                '                                            <span></span>\n' +
                '                                            ' + i + '.Week\n' +
                '                                        </label>\n' +
                '                                    </div>\n' +
                '                                </div>';
        }
        $('[name="week-field"]').html(html);

    });

    $(document).on('click', '[name="save-btn"]', function () {
        let selected_weeks = [];

        $('[name="week-field"] input').each(function (key, value) {
            if (this.checked) selected_weeks.push(this.name);
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/site_setting/save')}}',
            'type': 'POST',
            'data': {
                'start_date': $('[name="start_datetimepicker"] input').val(),
                'end_date': $('[name="end_datetimepicker"] input').val(),
                'selected_weeks': selected_weeks
            },
            beforeSend: function () {
                Swal.fire({
                    title: "@lang('body.processing')",
                    timer: 5000,
                    onOpen: function () {
                        Swal.showLoading()
                    }
                }).then(function (result) {
                    if (result.dismiss === "timer") {
                        console.log("I was closed by the timer")
                    }
                });
            },
            success: function (data) {
                if (undefined != data) {
                    setAlert('success', '@lang('alert.setting_save')', '@lang('alert.update_successfully')');
                }
            }, error: function (data) {
                setAlert('error', '@lang('alert.setting_save')', '@lang('alert.save_something_went_wrong')');
            }
        });
    });


    function YYYY_MM_DD(date) {
        return (date.split('.')[2] + '-' + date.split('.')[1] + '-' + date.split('.')[0]);
    }

    $(document).ready(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/site_setting/active_weeks')}}',
            'type': 'POST',
            'dataType': 'JSON',
            beforeSend: function () {

            },
            success: function (data) {
                if (undefined != data) {
                    $('[name="start_datetimepicker"] input').val(data.start_date)
                    $('[name="end_datetimepicker"] input').val(data.end_date)

                    Swal.fire({
                        title: "@lang('body.processing')",
                        timer: 2000,
                        onOpen: function () {
                            Swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === "timer") {
                            $('[name="calculate-btn"]').trigger('click');
                            let selected_week_array = data.active_weeks.substring(1, data.active_weeks.length - 1).replace(/"/g, '').split(',');
                            selected_week_array.forEach(function (value, key) {
                                $('[name="' + value + '"]').prop( "checked", true );
                            });
                        }
                    });
                }
            }, error: function (data) {
                console.log(data);
            }
        });
    });

</script>
