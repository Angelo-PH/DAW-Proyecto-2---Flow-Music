document.addEventListener('DOMContentLoaded', function () {
    // Obtener los campos del formulario
    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('password');
    var submitBtn = document.getElementById('submitBtn');

    // Función para validar los campos del formulario
    function validarCampos() {
        var email = emailInput.value.trim();
        var password = passwordInput.value.trim();

        // Verificar que ambos campos no estén vacíos
        if (email !== '' && password !== '') {
            // Verificar el formato del correo electrónico
            if (/^\S+@\S+\.\S+$/.test(email)) {
                // Habilitar el botón de enviar si los campos son válidos
                submitBtn.disabled = false;
                return;
            }
        }

        // Si no se cumplen las condiciones, deshabilitar el botón de enviar
        submitBtn.disabled = true;
    }

    // Agregar eventos de entrada para validar los campos en tiempo real
    emailInput.addEventListener('input', validarCampos);
    passwordInput.addEventListener('input', validarCampos);
});