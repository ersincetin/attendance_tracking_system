<script>

    var avatar3 = new KTImageInput('kt_profile_avatar');

    $(document).ready(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/getUser')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                id: 7
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
    });

    /** Save AJAX */
    $(document).on('click', '[name="save-btn"]', function () {
        /**Form Validation*/
        let i = 0;
        // let formInput = $('[name="user-form"]')[0];
        // $('.is-invalid').removeClass('is-invalid');
        // $('.is-valid').removeClass('is-valid');
        // for (let i = 0; i < formInput.length; i++) {
        //     console.log(formInput[i].type);
        //     if ((formInput[i].type == 'text' || formInput[i].type == 'email' || formInput[i].type == 'password')) {
        //         if (formInput[i].value.length > 0 && formInput[i].required) {
        //             formInput[i].classList.add('is-valid');
        //         } else {
        //             if (formInput[i].required) formInput[i].classList.add('is-invalid');
        //         }
        //     } else if (formInput[i].type == 'select-one') {
        //         if (formInput[i].value > 0 || formInput[i].value != 0) {
        //             formInput[i].classList.add('is-valid');
        //         } else {
        //             formInput[i].classList.add('is-invalid');
        //         }
        //     }
        // }
        // if ($('.is-invalid').length > 0) {
        //     return;
        // }
        let url;
        if ($('[name="userId"]').val().length > 0) {
            url = '{{url('admin/updateUser')}}';
        } else {
            url = '{{url('admin/createUser')}}';
        }

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
        formData.append('password', $('[name="password"]').val());

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
                    $('#user_modal').modal('hide');
                    if ($('[name="userId"]').val().length > 0) {
                        setAlert('success', '@lang('alert.user_update')', '@lang('alert.update_successfully')');
                    } else {
                        setAlert('success', '@lang('alert.user_add')', '@lang('alert.save_successfully')');
                    }
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
</script>
