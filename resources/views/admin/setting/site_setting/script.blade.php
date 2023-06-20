<script>

    $(document).ready(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/site_setting/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            success: function (data) {
                console.log(typeof data);

            }, error: function (data) {

            }
        });
    });

    $(document).on('click', '[name="save-btn"]', function () {
        /**Form Data Create*/
        let formData = new FormData();
        let homepage_file = $('[name="homepage-photo"]')[0].files;
        let admin_panel_file = $('[name="admin-panel-photo"]')[0].files;
        let admin_panel_mobile_file = $('[name="admin-panel-mobile-photo"]')[0].files;
        if (homepage_file.length > 0) formData.append('homepage_file', homepage_file[0]);
        if (admin_panel_file.length > 0) formData.append('admin_panel_file', admin_panel_file[0]);
        if (admin_panel_mobile_file.length > 0) formData.append('admin_panel_mobile_file', admin_panel_mobile_file[0]);
        formData.append('homepageHeader', $('[name="homepage-header"]').val());
        formData.append('homepageSubHeader', $('[name="homepage-subheader"]').val());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/site_setting/save')}}',
            'type': 'POST',
            'contentType': false,
            'processData': false,
            'data': formData,
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

    var homepage_logo = new KTImageInput('homepage-photo');
    var admin_panel_logo = new KTImageInput('admin-panel-photo');
    var admin_panel_mobile_logo = new KTImageInput('admin-panel-mobile-photo');
</script>
