<script>
    /**Form Validate Function*/
    function formValidate(formTagName) {
        let formInput = $('[name="' + formTagName + '"]')[0];
        $('.is-invalid').removeClass('is-invalid');
        $('.is-valid').removeClass('is-valid');
        /**
         * Required Control
         * */
        for (let i = 0; i < formInput.length; i++) {
            if ((formInput[i].type == 'text' || formInput[i].type == 'email' || formInput[i].type == 'password')) {
                if (formInput[i].value.length > 0 && formInput[i].required) {
                    formInput[i].classList.add('is-valid');
                    /** Identity Number Check*/
                    if (formInput[i].name == 'identityNumber')
                        if (!identityNumberControl(formInput[i].value)) {
                            setAlert('error', 'Failed', 'Identity Number Failed');
                            formInput[i].classList.add('is-invalid');
                        }

                } else {
                    /** Identity Number Check*/
                    if (formInput[i].value.length > 0 && formInput[i].name == 'identityNumber')
                        if (!identityNumberControl(formInput[i].value)) {
                            setAlert('error', 'Failed', 'Identity Number Failed');
                            formInput[i].classList.add('is-invalid');
                        }
                    
                    if (formInput[i].required) formInput[i].classList.add('is-invalid');
                }
            } else if (formInput[i].type == 'select-one') {
                if (formInput[i].value > 0 || formInput[i].value != 0) {
                    formInput[i].classList.add('is-valid');
                } else {
                    formInput[i].classList.add('is-invalid');
                }
            }
        }

        /**Password Equality Control*/
        if ($('[name="password"]').val() != $('[name="re-password"]').val()) {
            setAlert('error', 'Password Notification', 'Parolanız Eşleşmedi');
            /**Delete is-valid className*/
            $('[name="password"]').removeClass('is-valid');
            $('[name="re-password"]').removeClass('is-valid');
            /**Add is-invalid className*/
            $('[name="password"]').addClass('is-invalid');
            $('[name="re-password"]').addClass('is-invalid');
        } else {
            /**Delete is-invalid className*/
            $('[name="password"]').removeClass('is-invalid');
            $('[name="re-password"]').removeClass('is-invalid');
        }

        if ($('.is-invalid').length > 0) return false;

        return true;
    }
</script>
