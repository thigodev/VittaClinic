<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/geral.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/autentication/cadastro.css">
  <title>Vitta Clinic - Cadastre-se</title>
</head>

<body>

  <main class="register-container">
    <div class="additional-links">
      <p><a href="/clinic_management/views/landingPageView.php"><i class="bi bi-arrow-left"></i> Voltar para o
          portal</a></p>
    </div>
    <section class="form-section">
      <div class="form-header">
        <a href="/clinic_management/views/landingPageView.php">
          <img src="../public/img/vitta-logo-header.svg" alt="Logo Vitta" />
        </a>
      </div>
      <div class="form-container">
        <h1 class="register-title poppins-medium">Cadastre sua <span class="detail">Clínica</span></h1>

        <form method="post" action="/clinic_management/auth/register_clinic.php" class="register-form"
          id="registrationForm">
          <div class="input-group">
            <label for="clinic_name" class="input-label">Nome Fantasia<span class="required">*</span></label>
            <input type="text" id="clinic_name" name="clinic_name" class="input-field" placeholder="Ex: Clínica Vitta"
              required maxlength="100">
          </div>

          <div class="input-group">
            <label for="clinic_cnpj" class="input-label">CNPJ <span class="required">*</span></label>
            <input type="text" id="clinic_cnpj" name="clinic_cnpj" class="input-field"
              placeholder="Ex: 12.345.678/0001-90" required pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" maxlength="18">
          </div>

          <div class="input-group">
            <label for="clinic_email" class="input-label">E-mail <span class="required">*</span></label>
            <input type="email" id="clinic_email" name="clinic_email" class="input-field"
              placeholder="Ex: contato@clinicavitta.com.br" required maxlength="100">
          </div>

          <div class="input-group mb-0">
            <label for="clinic_password" class="input-label">Senha <span class="required">*</span></label>
            <i class="bi bi-eye-slash eye-icon" id="togglePassword"></i>
            <input type="password" id="clinic_password" name="clinic_password" class="input-field"
              placeholder="Senha (8 a 20 caracteres)" required minlength="8" maxlength="20">
          </div>
          <div id="passwordError" class="password-error"></div>

          <div class="footer-form-register">
            <button type="submit" class="register-btn" id="registerBtn">Cadastrar</button>
            <p>Já tem uma conta? <a href="/clinic_management/views/loginView.php"><strong>Entre agora</strong></a></p>
          </div>

        </form>
      </div>
    </section>

    <section class="side-container">
      <div class="side-content">
        <h2 class="impact-text">Transforme sua clínica <span class="highlight">com tecnologia</span>.</h2>
      </div>
    </section>
  </main>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('clinic_password');
    const passwordError = document.getElementById('passwordError');
    const registerBtn = document.getElementById('registerBtn');
    const registrationForm = document.getElementById('registrationForm');

    const passwordPattern = {
      minLength: 8,
      maxLength: 20,
      hasUpperCase: /[A-Z]/,
      hasNumber: /\d/,
      hasSpecialChar: /[!@#$%^&*(),.?":{}|<>]/,
      hasSequentialNumbers: /012|123|234|345|456|567|678|789|890|901/
    };

    function validatePassword(password) {
      let errorMessage = '';

      if (password.length > 0) {
        if (password.length < passwordPattern.minLength || password.length > passwordPattern.maxLength) {
          errorMessage = `A senha deve ter entre ${passwordPattern.minLength} e ${passwordPattern.maxLength} caracteres.`;
        }
        else if (!passwordPattern.hasUpperCase.test(password) ||
          !passwordPattern.hasNumber.test(password) ||
          !passwordPattern.hasSpecialChar.test(password)) {
          errorMessage = "A senha deve conter: letras maiúsculas, números e caracteres especiais (A-B #$%¨% 123).";
        }
        else if (passwordPattern.hasSequentialNumbers.test(password)) {
          errorMessage = "A senha não pode conter sequências numéricas (ex: 123, 234).";
        }
      }

      return errorMessage;
    }

    function showPasswordErrors(errorMessage) {
      if (errorMessage) {
        passwordError.innerHTML = errorMessage;
        passwordError.style.display = 'block';
        registerBtn.disabled = true;
      } else {
        passwordError.style.display = 'none';
        registerBtn.disabled = false;
      }
    }

    registrationForm.addEventListener('submit', function (event) {
      const password = passwordInput.value.trim();
      const errorMessage = validatePassword(password);

      if (errorMessage) {
        event.preventDefault();
        showPasswordErrors(errorMessage);
      }
    });

    passwordInput.addEventListener('input', function () {
      const password = passwordInput.value.trim();
      const errorMessage = validatePassword(password);
      showPasswordErrors(errorMessage);
    });

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      if (type === 'password') {
        togglePassword.classList.remove('bi-eye');
        togglePassword.classList.add('bi-eye-slash');
      } else {
        togglePassword.classList.remove('bi-eye-slash');
        togglePassword.classList.add('bi-eye');
      }
    });
  </script>

</body>

</html>