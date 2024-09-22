<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="icon" href="img/umbrella.svg">
  <title>Umbrella - Landing Page</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/landing_page/lp.css">
</head>

<body>
  <!-- <a href="/clinic_management/views/adminMasterView.php">clinica</a>
  <a href="/clinic_management/views/adminView.php">admin</a> -->
  <header id="home" class="header-bg">
    <div class="header">
      <img class="header-logo" src="/clinic_management/public/midia//img/umbrella-logo.svg">
      <a class="login-mobile poppins-semibold c01" href="#">Fazer Login</a>
      <nav>
        <ul class="header-menu" data-scroll="smooth">
          <li><a class="poppins-medium c10" href="#about">Sobre Nós</a></li>
          <li><a class="poppins-medium c10" href="#benefits">Vantagens</a></li>
          <li><a class="poppins-medium c10" href="#faq">FAQ</a></li>
        </ul>
        <a class="nav-btn poppins-semibold c01" href="/clinic_management/views/loginView.php">ENTRAR</a>
      </nav>
    </div>
  </header>
  <main class="home-bg" data-anima="show-up">
    <div class="home">
      <div class="home-content">
        <h1 class="home-title poppins-semibold c11">Inove na Gestão<br>da sua Clínica<span class="detail">.</span></h1>
        <p class="home-text roboto-regular c10">Agende consultas, gerencie pacientes, acompanhe registros médicos e controle sua clínica de forma integrada e segura.</p>
        <a class="home-btn poppins-semibold c01" href="/clinic_management/views/cadastroView.php">COMEÇAR AGORA</a>
      </div>
      <img class="home-img" src="/clinic_management/public/midia//img/home-img.png" alt="Site Umbrella por dentro">
    </div>
    <img class="home-img-mobile" src="/clinic_management/public/midia//img/home-img-mobile.svg">
  </main>
  <section id="about" class="about-bg">
    <div class="about" data-anima="show-left">
      <h1 class="about-title poppins-semibold c11">Sobre Nós<span class="detail">.</span></h1>
      <p class="about-text roboto-regular c10">Nosso objetivo é oferecer uma solução abrangente que permita aos médicos e administradores focarem no que realmente importa: o cuidado com os pacientes. Desde o agendamento de consultas até o acompanhamento do histórico médico, o Umbrella oferece ferramentas flexíveis e eficientes para otimizar todos os aspectos da operação clínica.</p>
      <img class="about-img" src="/clinic_management/public/midia//img/about-img.svg" width="500">
    </div>
  </section>

  <section id="benefits" class="benefits-bg">
    <div class="benefits">
      <h1 class="benefits-title poppins-semibold c01" data-anima="show-left">Vantagens<span class="detail-green">.</span></h1>
      <div class="benefits-container">
        <div class="item" data-anima="show-up">
          <img src="/clinic_management/public/midia//img/schedule.svg">
          <h3 class="item-title poppins-medium cBase02">Gestão de Agenda</h3>
          <p class="item-text roboto-regular c01">Simplifique a gestão dos seus compromissos com um sistema prático de agendamento. Otimize a administração com facilidade!</p>
        </div>
        <div class="item" data-anima="show-down">
          <img src="/clinic_management/public/midia//img/folder.svg">
          <h3 class="item-title poppins-medium cBase02">Prontuário Eletrônico</h3>
          <p class="item-text roboto-regular c01">Registre informações de pacientes em cada sessão e acesse os prontuários de forma conveniente, em qualquer lugar e a qualquer momento.</p>
        </div>
        <div class="item" data-anima="show-up">
          <img src="/clinic_management/public/midia//img/people.svg">
          <h3 class="item-title poppins-medium cBase02">Gestão de Pacientes</h3>
          <p class="item-text roboto-regular c01">Cadastre seus pacientes e tenha todos os dados essenciais na palma da mão, proporcionando uma gestão eficiente e acessível a qualquer momento.</p>
        </div>
      </div>
    </div>
  </section>
  <section id="faq" class="faq">
    <h1 class="faq-title poppins-semibold c11" data-anima="show-left">Perguntas Frequentes<span class="detail">.</span></h1>
    <dl class="faq-list" data-accordion="accordion" data-anima="show-up">
      <div class="accordion">
        <dt class="poppins-semibold c11">Para quem é direcionada a plataforma?</dt>
        <dd class="roboto-regular c10">
          O sistema da Umbrella é direcionado para clínicas, médicos e pacientes que querem facilidade no agendamento e no acompanhamento de consultas.
        </dd>
      </div>
      <div class="accordion">
        <dt class="poppins-semibold c11">Como posso entrar em contato?</dt>
        <dd class="roboto-regular c10">
          Você poed entrar em contato pelo email ou pelo telefone: <br>
          Email: umbrella@umbrela.com <br>
          Telefone: (99) 9999-9999
        </dd>
      </div>
      <div class="accordion">
        <dt class="poppins-semibold c11">É seguro?</dt>
        <dd class="roboto-regular c10">
          Sim, os dados são armazenados de forma segura no sistema, seguindo todas as diretrizes de privacidade e segurança de dados.
        </dd>
      </div>
      <div class="accordion">
        <dt class="poppins-semibold c11">Posso acessar os prontuários de qualquer lugar?</dt>
        <dd class="roboto-regular c10">Sim, você pode acessar os prontuários de qualquer lugar, desde que tenha uma conexão à internet e acesso ao sistema.</dd>
      </div>
    </dl>
  </section>

  <footer class="footer-bg">
    <div class="footer">
      <img class="logo-footer" src="/clinic_management/public/midia//img/umbrella-logo-footer.svg">
      <div class="contact">
        <h3 class="contact-title poppins-medium c01">Contato</h3>
        <ul data-scroll="smooth">
          <li><a class="roboto-regular c05" href="tel:+5599999999">+55 (99) 9999-9999</a></li>
          <li><a class="roboto-regular c05" href="mailto:umbrella@umbrella.com">umbrella@umbrella.com</a></li>
        </ul>
      </div>
      <div class="info">
        <h3 class="info-title poppins-medium c01">Informações</h3>
        <ul data-scroll="smooth">
          <li><a class="roboto-regular c05" href="#home">Início</a></li>
          <li><a class="roboto-regular c05" href="#about">Sobre Nós</a></li>
          <li><a class="roboto-regular c05" href="#benefits">Vantagens</a></li>
          <li><a class="roboto-regular c05" href="#faq">Perguntas Frequentes</a></li>
        </ul>
      </div>
      <p class="copyright roboto-regular c05">Umbrella © Direitos reservados.</p>
    </div>
  </footer>

  <script src="/clinic_management/public/scripts/lp.js"></script>
</body>

</html>