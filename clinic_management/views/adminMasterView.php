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

  <link rel="icon" href="../public/img/favicon.ico">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <title>Gestão de Administradores - Dashboard</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/global.css">
</head>

<body class="bg-light">
  <header class="header-master d-flex justify-content-between align-items-center p-3 text-white">
    <img src="/clinic_management/public/img/vitta-white.svg" alt="Logo da clínica" height="50">
    <button type="submit" onclick="location.href='logout.php'" class="btn btn-outline-light" aria-label="Sair">
      <i class="bi bi-box-arrow-right" alt="Ícone de sair"></i>
    </button>
  </header>

  <div class="container my-4">
    <h1 class="wellcome-title h3 mb-4"><?php echo htmlspecialchars("Gestão de Administradores"); ?></h1>
    <p class="text-muted mb-4">Nesta página, você pode visualizar e gerenciar os administradores da clínica. Você tem a
      opção de cadastrar novos administradores ou excluir os existentes. Utilize o botão abaixo para adicionar um novo
      administrador.</p>

    <a href="dashboard.php" class="btn btn-secondary mb-4">
      <i class="bi bi-arrow-left-circle"></i> Voltar para o Dashboard
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="h4 mb-0 text-secondary">Lista de Administradores</h3>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrarAdmin"
        aria-label="Cadastrar Administrador">
        <i class="bi bi-person-plus" alt="Ícone de adicionar administrador"></i>
      </button>
    </div>

    <!-- Exibe mensagem caso não haja administradores cadastrados -->
    <?php if (empty($admins)): ?>
      <div class="alert alert-info" role="alert">
        <strong>Atenção!</strong> Não há administradores cadastrados no momento. Cadastre um administrador para começar.
      </div>
    <?php else: ?>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($admins as $admin): ?>
            <tr>
              <td><?php echo htmlspecialchars($admin['id']); ?></td>
              <td><?php echo htmlspecialchars($admin['nome']); ?></td>
              <td><?php echo htmlspecialchars($admin['email']); ?></td>
              <td>
                <!-- Botão para abrir o modal de exclusão -->
                <button class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                  data-bs-toggle="modal" data-bs-target="#modalConfirmarExclusao"
                  data-id="<?php echo htmlspecialchars($admin['id']); ?>"
                  data-nome="<?php echo htmlspecialchars($admin['nome']); ?>" aria-label="Excluir administrador">
                  <i class="bi bi-trash" alt="Ícone de excluir administrador"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

  <!-- Modal de Cadastro de Administrador -->
  <div class="modal fade" id="modalCadastrarAdmin" tabindex="-1" aria-labelledby="modalCadastrarAdminLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCadastrarAdminLabel">Cadastrar Administrador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="/clinic_management/auth/register_admin.php">
            <div class="mb-3">
              <label for="user_name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nome*" required>
            </div>
            <div class="mb-3">
              <label for="user_email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <label for="user_senha" class="form-label">Senha</label>
              <input type="password" class="form-control" id="user_senha" name="user_senha" placeholder="Senha*"
                required>
            </div>
            <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
            <button type="submit" class="btn btn-primary w-100" aria-label="Cadastrar administrador">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Confirmação de Exclusão -->
  <div class="modal fade" id="modalConfirmarExclusao" tabindex="-1" aria-labelledby="modalConfirmarExclusaoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalConfirmarExclusaoLabel">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <p>Você tem certeza que deseja excluir o administrador <strong id="adminNome"></strong>?</p>
        </div>
        <div class="modal-footer">
          <form method="post" action="/clinic_management/auth/delete_admin.php" id="formExclusaoAdmin">
            <input type="hidden" name="id" id="adminId">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    // Script para passar dados para o modal de exclusão
    const modalExclusao = document.getElementById('modalConfirmarExclusao');
    modalExclusao.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const adminId = button.getAttribute('data-id');
      const adminNome = button.getAttribute('data-nome');

      const modalNome = modalExclusao.querySelector('#adminNome');
      const modalId = modalExclusao.querySelector('#adminId');

      modalNome.textContent = adminNome;
      modalId.value = adminId;
    });
  </script>
</body>

</html>