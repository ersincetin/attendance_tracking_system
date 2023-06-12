<script>
    function setRequiredDangerText(formTagName) {
        let formInput = $('[name="' + formTagName + '"]')[0];
        for (let i = 0; i < formInput.length; i++) {
            if ((formInput[i].type == 'text' || formInput[i].type == 'email' || formInput[i].type == 'password')) {
                if (formInput[i].required) $('[name="' + formInput[i].getAttribute('name') + '-label"]').html($('[name="' + formInput[i].getAttribute('name') + '-label"]').html() + ' <span class="text-danger">*</span>');
            }
        }
    }
</script>
