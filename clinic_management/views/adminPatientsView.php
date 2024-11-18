<?php
require_once '../config/Database.php';
require_once '../classes/Paciente.php';
require_once '../classes/Medico.php';
require_once '../classes/Consulta.php';

session_start();

$clinicaId = $_SESSION['id'];

$paciente = new Paciente(null, null, null, null, null, null);
$pacientes = $paciente->getAll($clinicaId); // Busca os pacientes

$medico = new Medico(null, null, null, null, null, null);
$medicos = $medico->getAll($clinicaId);

$consulta = new Consulta(null, null, null, null, null);
$consultas = $consulta->getAll($clinicaId);

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

    <title>Gestão de Pacientes</title>
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
        <h1 class="wellcome-title h3 mb-4"><?php echo htmlspecialchars("Gestão de Pacientes"); ?></h1>
        <p class="text-muted mb-4">Aqui você pode visualizar e gerenciar os pacientes da clínica. Utilize o botão abaixo
            para cadastrar novos pacientes ou excluir os existentes.</p>

        <a href="dashboard.php" class="btn btn-secondary mb-4">
            <i class="bi bi-arrow-left-circle"></i> Voltar para o Dashboard
        </a>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 mb-0 text-secondary">Lista de Pacientes</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCadastrarPaciente"
                aria-label="Cadastrar Paciente">
                <i class="bi bi-person-plus" alt="Ícone de adicionar paciente"></i>
            </button>
        </div>

        <!-- Exibe mensagem caso não haja pacientes cadastrados -->
        <?php if (empty($pacientes)): ?>
            <div class="alert alert-info" role="alert">
                <strong>Atenção!</strong> Não há pacientes cadastrados no momento. Cadastre um paciente para começar.
            </div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data de Nascimento</th>
                        <th>Sexo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($paciente['id']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['email']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['data_nascimento']); ?></td>
                            <td><?php echo htmlspecialchars($paciente['sexo']); ?></td>
                            <td>
                                <!-- Botão para abrir o modal de confirmação de exclusão -->
                                <button class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                    data-bs-toggle="modal" data-bs-target="#modalConfirmarExclusao"
                                    data-id="<?php echo htmlspecialchars($paciente['id']); ?>"
                                    data-nome="<?php echo htmlspecialchars($paciente['nome']); ?>">
                                    <i class="bi bi-trash" alt="Ícone de excluir paciente"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Modal para Cadastro de Paciente -->
    <div class="modal fade" id="modalCadastrarPaciente" tabindex="-1" aria-labelledby="modalCadastrarPacienteLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastrarPacienteLabel">Cadastrar Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/clinic_management/auth/register_paciente.php">
                        <div class="mb-3">
                            <label for="paciente_name" class="form-label">Nome do Paciente</label>
                            <input type="text" class="form-control" id="paciente_name" name="paciente_name"
                                placeholder="Nome*" required>
                        </div>
                        <div class="mb-3">
                            <label for="paciente_dt" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="paciente_dt" name="paciente_dt"
                                placeholder="Data de nascimento*" required>
                        </div>
                        <div class="mb-3">
                            <label for="paciente_sexo" class="form-label">Sexo</label>
                            <select id="paciente_sexo" name="paciente_sexo" class="form-select" required>
                                <option value="m">Masculino</option>
                                <option value="f">Feminino</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="paciente_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="paciente_email" name="paciente_email"
                                placeholder="Email*" required>
                        </div>
                        <div class="mb-3">
                            <label for="paciente_senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="paciente_senha" name="paciente_senha"
                                placeholder="Senha*" required>
                        </div>
                        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
                        <button type="submit" class="btn btn-primary w-100"
                            aria-label="Cadastrar Paciente">Cadastrar</button>
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
                    <p>Você tem certeza que deseja excluir o paciente <strong id="pacienteNome"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="/clinic_management/auth/delete_paciente.php" id="formExclusaoPaciente">
                        <input type="hidden" name="id" id="pacienteId">
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
            const pacienteId = button.getAttribute('data-id');
            const pacienteNome = button.getAttribute('data-nome');

            const modalNome = modalExclusao.querySelector('#pacienteNome');
            const modalId = modalExclusao.querySelector('#pacienteId');

            modalNome.textContent = pacienteNome;
            modalId.value = pacienteId;
        });
    </script>
</body>

</html>