<script src="{{asset("js/pages/features/miscellaneous/sweetalert2.js")}}"></script>
<script>
    function setAlert(type, title, message,callback) {
        switch (type) {
            case 'success':
                Swal.fire({
                    icon: "success",
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 2000
                });
                break;
            case 'warning':
                Swal.fire({
                    icon: "warning",
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 2000
                });
                break;
            case 'confirm':
                break;
            case 'error':
                Swal.fire({
                    icon: "error",
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 2000
                });
                break;
            default:
                Swal.fire({
                    icon: "info",
                    title: 'Bilgilendirme',
                    text: "Lütfen parametreleri kontrol ediniz.",
                    showConfirmButton: false,
                    timer: 2000
                });
        }
    }
</script>
