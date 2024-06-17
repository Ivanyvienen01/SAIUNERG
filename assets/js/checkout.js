// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  document.addEventListener('DOMContentLoaded', function() {
    // Obtener referencia a los botones de envío
    var registerBtn = document.querySelector('button[name="register_submit"]');
    var loginBtn = document.querySelector('button[name="login_submit"]');

    // Agregar controladores de eventos a los botones de envío
    registerBtn.addEventListener('click', function() {
        // Enviar el formulario de registro
        document.getElementById('registrationForm').submit();
    });

    loginBtn.addEventListener('click', function() {
        // Enviar el formulario de inicio de sesión
        document.getElementById('loginForm').submit();
    });
});

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
  
  // Validación de confirmación de contraseña en tiempo real
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm_password');
  const registerBtn = document.getElementById('registerBtn');

  confirmPasswordInput.addEventListener('input', () => {
    if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordInput.classList.add('is-invalid');
    } else {
        confirmPasswordInput.classList.remove('is-invalid');
    }
   checkFormValidity();
  });

  function checkFormValidity() {
    if (passwordInput.checkValidity() && confirmPasswordInput.checkValidity()) {
      registerBtn.disabled = false;
    } else {
        registerBtn.disabled = true;
    }
  }
})()


