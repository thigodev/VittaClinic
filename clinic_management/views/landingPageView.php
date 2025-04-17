<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" href="/clinic_management/public/styles/landing_page/lp.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/global.css">
  <title>Vitta Clinic</title>
</head>

<body>
  <header class="header" id="header">
    <img class="header-logo" src="/clinic_management/public/img/vitta-logo-header.svg" alt="Logo" >
    <nav>
      <ul class="header-menu">
        <li><a href="#about">Sobre Nós</a></li  >
        <li><a href="#benefits">Vantagens</a></li>
        <li><a href="#faq">FAQ</a></li>
      </ul>
      <a class="nav-btn" href="/clinic_management/views/loginView.php">LOGIN</a>
    </nav>
  </header>

  <main class="home">
    <div class="home-content">
      <h1 class="home-title">Modernize a gestão da sua clínica</h1>
      <p class="home-text">Simplifique etapas para cuidar melhor do seu negócio</p>
      <a class="home-btn" href="/clinic_management/views/cadastroView.php">CADASTRE-SE GRÁTIS</a>
    </div>
  </main>
  <section id="about" class="about">
    <div class="about-inner-container">
      <div class="about-text poppins-regular">
        <h1 class="about-title poppins-semibold c11">Sobre Nós<span class="detail">.</span></h1>
        <p>Nosso objetivo é oferecer uma solução completa que permita a médicos e administradores focar no essencial:
          o
          cuidado aos pacientes. </p>
        <p>O <strong>Vitta Clinic</strong>, desenvolvido por alunos do Centro Universitário Paraíso, disponibiliza
          ferramentas flexíveis
          e eficientes, abrangendo desde o agendamento de consultas até o acompanhamento do histórico médico,
          otimizando
          todos os aspectos da operação clínica. </p>
        <p>Atuamos principalmente na cidade de Juazeiro do Norte, atendendo às demandas das clínicas locais.</p>
      </div>
      <img src="/clinic_management/public/img/banner-about.svg" width="600px">
    </div>
  </section>

  <section id="benefits" class="benefits-bg">
    <div class="benefits">
      <h1 class="benefits-title poppins-semibold c01" data-anima="show-left">Vantagens<span
          class="detail-green">.</span></h1>
      <div class="benefits-container">
        <div class="item" data-anima="show-up">
          <img src="/clinic_management/public/img/schedule.svg">
          <h3 class="item-title poppins-medium c01">Gestão de Agenda</h3>
          <p class="item-text roboto-regular c01">Facilite a organização dos seus compromissos com um sistema de
            agendamento eficiente. Torne a administração mais ágil e descomplicada!</p>
        </div>
        <div class="item" data-anima="show-down">
          <img src="/clinic_management/public/img/folder.svg">
          <h3 class="item-title poppins-medium c01">Prontuário Eletrônico</h3>
          <p class="item-text roboto-regular c01">Documente as informações dos pacientes em cada consulta e acesse os
            prontuários de maneira prática, a qualquer hora e em qualquer lugar.</p>
        </div>
        <div class="item" data-anima="show-up">
          <img src="/clinic_management/public//img/people.svg">
          <h3 class="item-title poppins-medium c01">Gestão de Pacientes</h3>
          <p class="item-text roboto-regular c01">Registre seus pacientes e tenha acesso a todos os dados essenciais na
            palma da mão, garantindo uma administração eficiente e acessível sempre que necessário.</p>
        </div>
      </div>
    </div>
  </section>
  <section id="faq" class="faq">
    <h1 class="faq-title poppins-semibold c11" data-anima="show-left">Perguntas Frequentes<span class="detail">.</span>
    </h1>
    <dl class="faq-list" data-accordion="accordion" data-anima="show-up">
      <div class="accordion">
        <dt class="poppins-semibold c11">Para quem é direcionada a plataforma?</dt>
        <dd class="roboto-regular c10">
          O sistema da Vitta é projetado para clínicas, médicos e pacientes que buscam praticidade no agendamento e no
          acompanhamento de consultas. Com uma interface intuitiva, ele facilita a gestão do atendimento, tornando o
          processo mais ágil e eficiente.
        </dd>
      </div>
      <div class="accordion">
        <dt class="poppins-semibold c11">Como posso entrar em contato?</dt>
        <dd class="roboto-regular c10">
          Você pode entrar em contato pelo email ou pelo telefone: <br>
          Email: vitta@vitta.com <br>
          Telefone: (99) 9999-9999
        </dd>
      </div>
      <div class="accordion">
        <dt class="poppins-semibold c11">É seguro?</dt>
        <dd class="roboto-regular c10">
          Sim, os dados são armazenados com segurança no sistema, em conformidade com todas as diretrizes de privacidade
          e proteção de informações.
        </dd>
      </div>
      <div class="accordion">
        <dt class="poppins-semibold c11">Posso acessar os prontuários de qualquer lugar?</dt>
        <dd class="roboto-regular c10">
          Sim, é possível acessar os prontuários de qualquer lugar, desde que você tenha uma conexão à internet e acesso
          ao sistema.</dd>
      </div>
    </dl>
  </section>

  <footer class="footer-bg">
    <div class="footer">
      <img class="logo-footer" src="/clinic_management/public/img/vitta-white.svg">
      <div class="contact">
        <h3 class="contact-title poppins-medium c01">Contato</h3>
        <ul data-scroll="smooth">
          <li><a class="roboto-regular c05" href="tel:+5599999999">+55 (99) 9999-9999</a></li>
          <li><a class="roboto-regular c05" href="mailto:umbrella@umbrella.com">vitta@vitta.com</a></li>
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
      <p class="copyright roboto-regular c05">Vitta © Direitos reservados.</p>
    </div>
  </footer>

  <script src="/clinic_management/public/scripts/lp.js"></script>
  <script src="/clinic_management/public/scripts/header.js"></script>
</body>

</html>