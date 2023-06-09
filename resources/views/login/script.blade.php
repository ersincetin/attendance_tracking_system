<script>
    $(document).on('click', '[name="sign-in"]', function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('login/auth')}}',
            'async': true,
            'type': 'POST',
            'dataType': 'JSON',
            'data': $('[name="sign-in-form"]').serialize(),
            beforeSend: function () {
                Swal.fire({
                    title: "Loading",
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
                if (data) {
                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            title: 'Redirect',
                            text: 'Please wait',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(function (result) {
                            window.location.replace('{{url("admin/dashboard")}}');
                        });
                    }, 1500);
                }

            }, error: function (data) {

            }, complete: function () {
            }
        });
    });
</script>
