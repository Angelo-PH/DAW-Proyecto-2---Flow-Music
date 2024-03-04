document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe por defecto

    // Obtenemos los valores de los campos
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Variables para almacenar los mensajes de error
    var emailError = '';
    var passwordError = '';

    // Validamos el correo electrónico
    if (!email) {
        emailError = 'Por favor ingrese su correo electrónico';
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        emailError = 'Por favor ingrese un correo electrónico válido';
    }

    // Validamos la contraseña
    if (!password) {
        passwordError = 'Por favor ingrese su contraseña';
    } else if (password.length < 6) {
        passwordError = 'La contraseña debe tener al menos 6 caracteres';
    }

    // Mostramos los mensajes de error
    document.getElementById('emailError').textContent = emailError;
    document.getElementById('passwordError').textContent = passwordError;

    // Si no hay errores, enviamos el formulario
    if (!emailError && !passwordError) {
        // Aquí podrías hacer una petición AJAX para enviar los datos al servidor
        alert('¡Formulario enviado correctamente!');
        // Aquí podrías redirigir al usuario a la página de inicio de sesión o a otra página
    }
});