<script src="https://www.google.com/recaptcha/api.js?render=6LeUIrcZAAAAAKEfGqiFsksFwZm8LrpZJINmOFK1"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6LeUIrcZAAAAAKEfGqiFsksFwZm8LrpZJINmOFK1', { action: 'submit' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>
