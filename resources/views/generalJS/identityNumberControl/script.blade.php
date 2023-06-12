<script>
    /**Identity Number Control Function*/
    function identityNumberControl(identityNumber) {
        if (identityNumber.length != 11) return false;
        if (isNaN(identityNumber)) return false;
        if (identityNumber[0] == 0) return false;

        let odd = 0, even = 0, result = 0, digitTotal = 0;
        let errorList = [11111111110, 22222222220, 33333333330, 44444444440, 55555555550, 66666666660, 7777777770, 88888888880, 99999999990];
        odd = parseInt(identityNumber[0]) + parseInt(identityNumber[2]) + parseInt(identityNumber[4]) + parseInt(identityNumber[6]) + parseInt(identityNumber[8]);
        even = parseInt(identityNumber[1]) + parseInt(identityNumber[3]) + parseInt(identityNumber[5]) + parseInt(identityNumber[7]);

        odd = odd * 7;
        result = Math.abs(odd - even);
        if (result % 10 != identityNumber[9]) return false;

        for (let i = 0; i < 10; i++) {
            digitTotal += parseInt(identityNumber[i]);
        }
        if (digitTotal % 10 != identityNumber[10]) return false;

        if (errorList.toString().indexOf(identityNumber) != -1) return false;

        return true;
    }
</script>
