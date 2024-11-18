<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/favicon.ico">
  <title>Cadastro de Clínica</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/autentication/cadastro.css">
</head>

<body>
  <header id="home" class="header-bg">
    <div class="header">
      <a href="/clinic_management/views/landingPageView.php">
        <img class="header-logo" src="/clinic_management/public/img/vitta-white.svg" alt="Logo Vitta">
      </a>
    </div>
  </header>

  <section class="form-section">
    <h1 class="sign-up-title poppins-medium c11">Cadastre sua <span class="detail poppins-semibold">clínica</span></h1>
    <form method="post" action="/clinic_management/auth/register_clinic.php">
      <div class="input-container">
        <label for="clinic_name" class="roboto-regular">Nome da Clínica <span class="required">*</span></label>
        <input type="text" id="clinic_name" name="clinic_name" class="roboto-regular" placeholder="Ex: Clínica Vitta"
          required maxlength="100">
      </div>

      <div class="input-container">
        <label for="clinic_cnpj" class="roboto-regular">CNPJ <span class="required">*</span></label>
        <input type="text" id="clinic_cnpj" name="clinic_cnpj" class="roboto-regular"
          placeholder="Ex: 12.345.678/0001-90" required pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" maxlength="18">
      </div>

      <div class="input-container">
        <label for="clinic_email" class="roboto-regular">E-mail <span class="required">*</span></label>
        <input type="email" id="clinic_email" name="clinic_email" class="roboto-regular"
          placeholder="Ex: contato@clinicavitta.com.br" required maxlength="100">
      </div>

      <div class="input-container">
        <label for="clinic_password" class="roboto-regular">Senha <span class="required">*</span></label>
        <input type="password" id="clinic_password" name="clinic_password" class="roboto-regular"
          placeholder="Senha (8 a 20 caracteres)" required minlength="8" maxlength="20">
      </div>

      <button type="submit" class="sign-up-btn poppins-semibold c01">Cadastrar</button>
    </form>
  </section>

</body>

</html>