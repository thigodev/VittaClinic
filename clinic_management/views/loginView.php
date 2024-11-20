<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" href="/clinic_management/public/styles/autentication/login.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/geral.css">
  <title>Vitta Clinic - Login</title>
</head>

<body>

  <main class="login-container">
    <!-- Bloco de vídeo -->
    <section class="video-container">
      <video autoplay muted loop>
        <source src="../public/img/video-login.mp4" type="video/mp4">
        Seu navegador não suporta o vídeo.
      </video>
      <p class="info-video">©Direitos reservados - Vitta Clinic 2024</p>
    </section>

    <!-- Formulário de login -->
    <section class="form-container">
      <div class="top-form-container-logo">
        <img src="../public/img/vitta-logo-header.svg" alt="logo" />
      </div>
      <div class="form-inner-container">
        <h1 class="sign-in-title poppins-medium c11">Entre na sua conta</h1>
        <form method="post" action="/clinic_management/auth/login.php">
          <select id="user_type" name="user_type" required>
            <option value="clinica">Clínica</option>
            <option value="admin">Admin</option>
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
          </div>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <div class="back-to-dashboard">
          <a href="/clinic_management/views/landingPageView.php">Voltar para o portal</a>
        </div>
      </div>
    </section>
  </main>

</body>

</html>