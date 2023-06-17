<script>
    let permission = {}, permissionList = [];
    $(document).on('click', '[name="save-btn"]', function () {
        /*** Multi Get Form Data's **/
        let i = 0;
        $('[name="permission-form"] input').each(function (key, value) {
            if (permission[this.name] != undefined) {
                permission = {};
            }
            permission[this.name] = this.checked ? 1 : 0;
            permissionList[this.getAttribute('data-label')] = permission;

        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/role/permission/update')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                'roleId': {{ $id }},
                'permission': Object.assign({}, permissionList)
            },
            success: function (data) {
                if (undefined != data) {
                    setAlert('success', '@lang('alert.role_permission_update')', '@lang('alert.update_successfully')');
                }
            }, error: function (data) {
                setAlert('error', '@lang('alert.role_permission_update')', '@lang('alert.update_something_went_wrong')');
            }
        });
    });

    $(document).on('click', '.la-check-square', function () {
        $('[name="' + this.getAttribute('data-label') + '"] input').each(function (key, value) {
            this.checked = true;
        });
        this.classList.remove('la-check-square', 'text-primary');
        this.classList.add('la-times-rectangle', 'text-danger');
    });

    $(document).on('click', '.la-times-rectangle', function () {
        $('[name="' + this.getAttribute('data-label') + '"] input').each(function (key, value) {
            this.checked = false;
        });
        this.classList.add('la-check-square', 'text-primary');
        this.classList.remove('la-times-rectangle', 'text-danger');
    });

    $(document).ready(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/settings/role/permission/list')}}',
            'type': 'POST',
            'dataType': 'JSON',
            'data': {
                'roleId': {{ $id }},
            },
            success: function (data) {
                if (undefined != data && null != data) {
                    console.log(JSON.parse(data.permission));
                    Object.entries(JSON.parse(data.permission)).forEach(entry => {
                        const [key, value] = entry;
                        $('[data-label="' + key + '"]').each(function () {
                            if (value[this.name] != 0 ) this.checked = true;
                        });
                    });
                }
            }, error: function (data) {

            }
        });
    });
</script>
