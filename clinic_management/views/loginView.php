<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Umbrella-Login</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/autentication/cadastro.css">
</head>

<body>
  <header id="home" class="header-bg">
    <div class="header">
      <a href="/clinic_management/views/landingPageView.php">
        <img class="header-logo" src="/clinic_management/public/midia/img/umbrella-logo.svg">
      </a>
    </div>
  </header>

  <section>
    <h1 class="sign-in-title poppins-medium c11">Entre na sua conta</h1>
    <form method="post" action="/clinic_management/auth/login.php">
      <select id="user_type" name="user_type">
        <option value="clinica">Clínica</option>
        <option value="admin">Admin</option>
        <option value="medico">Médico</option>
        <option value="paciente">Paciente</option>
      </select>
      <div class="input-container">
        <label class="roboto-regular">Email</label>
        <input type="email" class="roboto-regular" name="user_email" placeholder="Email*" required>
      </div>
      <div class="input-container">
        <label class="roboto-regular">Senha</label>
        <input type="password" class="roboto-regular" name="user_password" placeholder="Senha*" required>
      </div>
      <button type="submit" class="sign-in-btn poppins-semibold c01">Entrar</button>
    </form>
  </section>
</body>

</html>