<script>

    var avatar3 = new KTImageInput('kt_profile_avatar');

    $(document).ready(function () {
        getProfileDetail();
    });

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {
        /**Form Data Create*/
        let formData = new FormData();
        let file = $('[name="profile_avatar"]')[0].files;
        if (file.length > 0) formData.append('file', file[0]);
        formData.append('userId', $('[name="userId"]').val());
        formData.append('userType', $('[name="userType"]').val());
        formData.append('sex', $('[name="sex"]').val());
        formData.append('username', $('[name="username"]').val());
        formData.append('identityNumber', $('[name="identityNumber"]').val());
        formData.append('firstname', $('[name="firstname"]').val());
        formData.append('secondName', $('[name="secondName"]').val());
        formData.append('lastname', $('[name="lastname"]').val());
        formData.append('email', $('[name="email"]').val());

        if ($('[name="password-field"]').hasClass('d-block')) {
            if ($('[name="current-password"]').val().length == 0) {
                setAlert('error', '@lang('alert.current_password')', '@lang('alert.current_password_field_error')');
                return;
            } else if ($('[name="current-password"]').val() == $('[name="new-password"]').val()) {
                setAlert('error', '@lang('alert.password_error')', '@lang('alert.new_current_password_error')');
                return;
            } else {
                if ($('[name="new-password"]').val() != $('[name="verify-password"]').val()) {
                    setAlert('error', '@lang('alert.current_password')', '@lang('alert.current_password_field_error')');
                    return;
                }
                formData.append('password', $('[name="new-password"]').val());
                formData.append('verifyPassword', $('[name="verify-password"]').val());
                formData.append('currentPassword', $('[name="current-password"]').val());
            }
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': "{{url('admin/user/update')}}",
            'type': 'POST',
            'contentType': false,
            'processData': false,
            'data': formData,
            success: function (data) {
                if (undefined != data) {
                    $('#user_modal').modal('hide');
                    if ($('[name="userId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.user_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.user_add')', '@lang('alert.save_successfully')');
                    }
                    getProfileDetail();
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

    $(document).on('click', '.navi-link-rounded > .navi-item > a', function () {
        let aItems = $('.navi-link-rounded > .navi-item > a');
        aItems.removeClass('active');
        for (let i = 0; i < aItems.length; i++) {
            if ($(this).attr('data-label') == aItems[i].dataset.label) {
                $('[name="' + aItems[i].dataset.label + '"]').removeClass('d-none');
                $('[name="' + aItems[i].dataset.label + '"]').addClass('d-block');
            } else {
                $('[name="' + aItems[i].dataset.label + '"]').removeClass('d-block');
                $('[name="' + aItems[i].dataset.label + '"]').addClass('d-none');
            }
        }
        $(this).addClass('active');
    })

    function getProfileDetail() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/user/get')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: {{Auth::user()->id}}
            },
            beforeSend: function () {
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    $('[name="userId"]').val(data.id);
                    $('[name="userType"]').val(data.role_id);
                    $('[name="sex"]').val(data.sex);
                    $('[name="username"]').val(data.username);
                    $('[name="identityNumber"]').val(data.identity_number);
                    $('[name="firstname"]').val(data.firstname);
                    $('[name="secondName"]').val(data.second_name);
                    $('[name="lastname"]').val(data.lastname);
                    $('[name="fullName"]').text(data.firstname + ' ' + (data.second_name != null ? data.second_name + ' ' : '') + data.lastname);
                    $('[name="email"]').val(data.email);
                    $('[name="email"]').text(data.email);
                    if (data.photo_url != null) $('[name="profile-photo"]').css('background-image', 'url(' + '{{asset("media/photos/users/")}}' + '/' + data.photo_url + ')');
                }
            }, error: function (data) {

            }, complete: function () {
            },
        });
    }
</script>
