<?php
require_once '../config/Database.php';
require_once '../classes/Medico.php';

session_start();

$clinicaId = $_SESSION['id'];
$medico = new Medico(null, null, null, null, null, $clinicaId);
$medicos = $medico->getAll($clinicaId);

$adminName = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <link rel="icon" href="img/umbrella.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Gestão de Médicos</title>
    <link rel="stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
</head>

<body class="bg-light">
    <header class="header-master d-flex justify-content-between align-items-center p-3 text-white">
        <img src="/clinic_management/public/img/vitta-white.svg" alt="Logo da clínica" height="50">
        <button type="submit" onclick="location.href='logout.php'" class="btn btn-outline-light" aria-label="Sair">
            <i class="bi bi-box-arrow-right" alt="Ícone de sair"></i>
        </button>
    </header>

    <div class="container my-4">
        <h1 class="wellcome-title h3 mb-4"><?php echo htmlspecialchars("Gestão de Médicos"); ?></h1>
        <p class="text-muted mb-4">Nesta página, você pode visualizar e gerenciar os médicos da clínica. Você pode
            cadastrar novos médicos ou excluir os existentes. Utilize o botão abaixo para adicionar um novo médico.</p>

        <a href="dashboard.php" class="btn btn-secondary mb-4">
            <i class="bi bi-arrow-left-circle"></i> Voltar para o Dashboard
        </a>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 mb-0 text-secondary">Lista de Médicos</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrarMedico"
                aria-label="Cadastrar Médico">
                <i class="bi bi-person-plus" alt="Ícone de adicionar médico"></i>
            </button>
        </div>

        <?php if (empty($medicos)): ?>
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="bi bi-folder-lock" style="font-size: 1.5rem; margin-right: 10px;"></i>
                <strong>Não há dados cadastrados</strong>
            </div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>CRM</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicos as $medico): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($medico['id']); ?></td>
                            <td><?php echo htmlspecialchars($medico['nome']); ?></td>
                            <td><?php echo htmlspecialchars($medico['especialidade']); ?></td>
                            <td><?php echo htmlspecialchars($medico['crm']); ?></td>
                            <td><?php echo htmlspecialchars($medico['email']); ?></td>
                            <td>
                                <!-- Botão para abrir o modal de confirmação de exclusão -->
                                <button class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modalConfirmarExclusao"
                                    data-id="<?php echo htmlspecialchars($medico['id']); ?>"
                                    data-nome="<?php echo htmlspecialchars($medico['nome']); ?>">
                                    <i class="bi bi-trash" alt="Ícone de excluir médico"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Modal para Cadastro de Médico -->
    <div class="modal fade" id="modalCadastrarMedico" tabindex="-1" aria-labelledby="modalCadastrarMedicoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastrarMedicoLabel">Cadastrar Médico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/clinic_management/auth/register_medico.php">
                        <div class="mb-3">
                            <label for="medico_name" class="form-label">Nome do Médico</label>
                            <input type="text" class="form-control" id="medico_name" name="medico_name"
                                placeholder="Nome*" required>
                        </div>
                        <div class="mb-3">
                            <label for="medico_especialidade" class="form-label">Especialidade</label>
                            <input type="text" class="form-control" id="medico_especialidade"
                                name="medico_especialidade" placeholder="Especialidade*" required>
                        </div>
                        <div class="mb-3">
                            <label for="medico_crm" class="form-label">CRM</label>
                            <input type="text" class="form-control" id="medico_crm" name="medico_crm" placeholder="CRM*"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="medico_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="medico_email" name="medico_email"
                                placeholder="Email*" required>
                        </div>
                        <div class="mb-3">
                            <label for="medico_senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="medico_senha" name="medico_senha"
                                placeholder="Senha*" required>
                        </div>
                        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
                        <button type="submit" class="btn btn-primary w-100"
                            aria-label="Cadastrar Médico">Cadastrar</button>
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
                    <p>Você tem certeza que deseja excluir o médico <strong id="medicoNome"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="/clinic_management/auth/delete_medico.php" id="formExclusao">
                        <input type="hidden" name="id" id="medicoId">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Script para passar dados para o modal de exclusão -->
    <script>
        const modalExclusao = document.getElementById('modalConfirmarExclusao');
        modalExclusao.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const medicoId = button.getAttribute('data-id');
            const medicoNome = button.getAttribute('data-nome');

            const modalNome = modalExclusao.querySelector('#medicoNome');
            const modalId = modalExclusao.querySelector('#medicoId');

            modalNome.textContent = medicoNome;
            modalId.value = medicoId;
        });
    </script>
</body>

</html>