$(document).ready(function () {
    $("#show_password").click(function () {
        var passwordInput = $('input[name="password_confirmation"]');
        var passwordInput1 = $('input[name="password"]');
        var passwordType = passwordInput1.prop('type');
        if (passwordType === 'password') {
            passwordInput.prop('type', 'text');
            passwordInput1.prop('type', 'text');
            $("#show_icon").removeClass('fas fa-eye').addClass('fas fa-eye-slash');
        } else {
            passwordInput.prop('type', 'password');
            passwordInput1.prop('type', 'password');
            $("#show_icon").removeClass('fas fa-eye-slash').addClass('fas fa-eye');
        }
    });
    $("#show_current_password").click(function () {
        var passwordCurrentInput = $('input[name="current_password"]');
        var passwordCurrentType = passwordCurrentInput.prop('type');
        if (passwordCurrentType === 'password') {
            passwordCurrentInput.prop('type', 'text');
            $("#show_current_icon").removeClass('fas fa-eye').addClass('fas fa-eye-slash');
        } else {
            passwordCurrentInput.prop('type', 'password');
            $("#show_current_icon").removeClass('fas fa-eye-slash').addClass('fas fa-eye');
        }
    });
    $("#generate_password").click(function () {
        function generatePassword(length) {
            var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~|}{[];?></-=";
            var password = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
                password += charset.charAt(Math.floor(Math.random() * n));
            }
            return password;
        }
        var newPassword = generatePassword(10);
        $('input[name="password"]').val(newPassword);
        $('input[name="password_confirmation"]').val(newPassword);
    });
});
