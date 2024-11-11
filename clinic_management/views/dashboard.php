<?php
session_start();
$clinicName = $_SESSION['nome'];
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

    <title>Dashboard - Clínica</title>
    <link rel="stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
</head>

<body class="bg-light">
    <!-- Cabeçalho -->
    <header class="header-master d-flex justify-content-between align-items-center p-3 text-white">
        <img src="/clinic_management/public/img/vitta-white.svg" alt="Logo da clínica" height="50">
        <button type="submit" onclick="location.href='logout.php'" class="btn btn-outline-light" aria-label="Sair">
            <i class="bi bi-box-arrow-right" alt="Ícone de sair"></i>
        </button>
    </header>

    <!-- Conteúdo do Dashboard -->
    <div class="container my-4">
        <!-- Saudação -->
        <h1 class="wellcome-title h3 mb-4 "><?php echo "Bem-vindo, {$clinicName}"; ?></h1>

        <!-- Cards de Resumo -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Administradores</h5>
                        <p class="card-text text-center"><strong>5</strong> Administradores</p>
                        <a href="admin_master_view.php" class="btn btn-outline-primary w-100">Ver detalhes</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Consultas</h5>
                        <p class="card-text text-center"><strong>120</strong> Consultas agendadas</p>
                        <a href="consultas.php" class="btn btn-outline-primary w-100">Ver detalhes</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pacientes</h5>
                        <p class="card-text text-center"><strong>300</strong> Pacientes registrados</p>
                        <a href="pacientes.php" class="btn btn-outline-primary w-100">Ver detalhes</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Receitas</h5>
                        <p class="card-text text-center"><strong>R$ 15.000</strong> em receitas mensais</p>
                        <a href="receitas.php" class="btn btn-outline-primary w-100">Ver detalhes</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Links rápidos -->
        <div class="row">
            <div class="col-12 mb-4">
                <h4 class="text-secondary">Acesso rápido</h4>
                <div class="d-flex justify-content-start gap-3">
                    <a href="admin_master_view.php" class="btn btn-outline-info d-flex align-items-center">
                        <i class="bi bi-person-plus me-2"></i> Cadastrar Administrador
                    </a>
                    <a href="consultas.php" class="btn btn-outline-info d-flex align-items-center">
                        <i class="bi bi-calendar-check me-2"></i> Agendar Consulta
                    </a>
                    <a href="pacientes.php" class="btn btn-outline-info d-flex align-items-center">
                        <i class="bi bi-person-lines-fill me-2"></i> Pacientes
                    </a>
                </div>
            </div>
        </div>

        <!-- Resumo de Atividades -->
        <div class="row">
            <div class="col-12 mb-4">
                <h4 class="text-secondary">Resumo das Atividades Recentes</h4>
                <!-- Aqui você pode adicionar gráficos, tabelas ou listas com as atividades mais recentes -->
                <div class="alert alert-info">
                    <strong>Nota:</strong> Não há novas atividades para mostrar.
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>