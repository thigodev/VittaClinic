<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="/clinic_management/public/styles/autentication/login.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/geral.css">
  <title>Vitta Clinic - Login</title>
</head>

<body>

  <main class="login-container">
    <section class="video-container">
      <p class="info-video">©Direitos reservados - Vitta Clinic 2025</p>
    </section>

    <section class="form-container">
      <div class="top-form-container-logo">
        <a href="/clinic_management/views/landingPageView.php">
          <img src="../public/img/vitta-logo-header.svg" alt="logo" />
        </a>
      </div>
      <div class="form-inner-container">
        <h1 class="sign-in-title poppins-medium c11">Entre na sua conta</h1>
        <form method="post" action="/clinic_management/auth/login.php">
          <select id="user_type" name="user_type" required>
            <option value="clinica">Clínica Gestora</option>
            <option value="admin">Administrador</option>
            <option value="medico">Médico</option>
            <option value="paciente">Paciente</option>
          </select>
          <div class="input-container">
            <label class="roboto-regular" for="user_email">E-mail <strong class="danger">*</strong></label>
            <input type="email" id="user_email" class="roboto-regular" name="user_email"
              placeholder="Exemplo: vitta@gmail.com" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular" for="user_password">Senha <strong class="danger">*</strong></label>
            <input type="password" id="user_password" class="roboto-regular" name="user_password"
              placeholder="**********" required>
            <i class="bi bi-eye-slash eye-icon" id="togglePassword"></i>
          </div>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <div class="forgot-password">
          <i class="bi bi-info-circle"></i>
          <span>Esqueceu a senha? <strong class="strong-primary">
              Entre em contato com a clínica gestora.
            </strong></span>
        </div>
      </div>
      <div class="back-to-dashboard" style="position: absolute; bottom: 20px; text-align: center;">
        <a href="/clinic_management/views/landingPageView.php">
          <i class="bi bi-arrow-left"></i>
          Voltar para o portal
        </a>
      </div>
    </section>


  </main>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('user_password');

    function toggleEyeIcon() {
      if (passwordInput.value.length > 0) {
        togglePassword.style.display = 'block';
      } else {
        togglePassword.style.display = 'none';
      }
    }

    toggleEyeIcon();

    passwordInput.addEventListener('input', toggleEyeIcon);

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