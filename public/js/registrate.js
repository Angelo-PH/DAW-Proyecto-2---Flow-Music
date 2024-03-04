document.getElementById('btn-login').addEventListener('click', function () {
    var loginForm = document.getElementById('login-form');
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
    } else {
        loginForm.style.display = 'none';
    }
});
