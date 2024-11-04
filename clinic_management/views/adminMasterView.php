<?php
require_once '../config/Database.php';
require_once '../classes/AdminPadrao.php';

session_start();

$clinicName = $_SESSION['nome'];
$clinicaId = $_SESSION['id'];

$adminPadrao = new AdminPadrao(null, null, null, null);
$admins = $adminPadrao->getAll($clinicaId);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="icon" href="img/umbrella.svg">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css"
    integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

  <title>Clinica Dashboard</title>
  <link rel=" stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
</head>

<body>
  <header class="header-master">
    <img src="/clinic_management/public/img/vitta-white.svg">
    <button type="submit" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold c01">
      <span class="glyphicon glyphicon-log-out"></span>
    </button>
  </header>

  <div class="container">
    <h1 class="wellcome-title poppins-semibold c11"><?php echo htmlspecialchars("Bem-vinda, {$clinicName} ") ?></h1>

    <button class="create-btn open-modal-btn poppins-semibold c01">Cadastrar Administrador</button>

    <div>
      <h3 class="poppins-semibold c11">Lista de Administradores</h3>
      <table>
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Nome</th>
            <th>Email</th>
            <th class="last">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($admins as $admin): ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($admin['id']); ?></td>
              <td><?php echo htmlspecialchars($admin['nome']); ?></td>
              <td><?php echo htmlspecialchars($admin['email']); ?></td>
              <td>
                <form class="form-delete-table" method="post" action="/clinic_management/auth/delete_admin.php"
                  onsubmit="return confirm('Você tem certeza que deseja excluir este admin?');">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin['id']); ?>">
                  <button class="roboto-regular c11" type="submit">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div id="modal" class="modal-container">
    <div class="modal-box">
      <h2 class="modal-title poppins-semibold">Cadastrar Administrador</h2>
      <div class="modal-content">
        <form method="post" action="/clinic_management/auth/register_admin.php">
          <div class="input-container">
            <label class="roboto-regular">Nome</label>
            <input type="text" class="roboto-regular" name="user_name" placeholder="Nome*" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular">E-mail</label>
            <input type="email" class="roboto-regular" name="user_email" placeholder="Email" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular">Senha</label>
            <input type="password" class="roboto-regular" name="user_senha" placeholder="Senha*" required>
          </div>
          <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
          <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>

  <script type="module" src="../public/scripts/main.js"></script>
</body>

</html>