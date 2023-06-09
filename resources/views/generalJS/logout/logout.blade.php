<script>
    $(document).on('click', '[name="logout"]', function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url': '{{url('admin/logout')}}',
            'async': true,
            'type': 'POST',
            beforeSend: function () {
                Swal.fire({
                    title: "Processing",
                    timer: 2500,
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
                if (data != undefined) {
                    setTimeout(function () {
                        Swal.fire({
                            icon: "success",
                            title: 'Logout Successfully',
                            text: 'Please wait',
                            showConfirmButton: false,
                            timer: 2500
                        }).then(function (result) {
                            window.location.replace('{{url("/")}}');
                        });
                    }, 1500);
                }

            }, error: function (data) {

            }, complete: function () {
            }
        });
    });
</script>
