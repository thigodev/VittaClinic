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
    <link rel="stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
    <link rel="stylesheet" href="/clinic_management/public/styles/global/geral.css">
    <title>Dashboard</title>
</head>

<body class="bg-light">
    <header class="header-master d-flex justify-content-between align-items-center p-3 text-white">
        <img src="/clinic_management/public/img/vitta-white.svg" alt="Logo da clínica" height="50">
        <button type="submit" onclick="location.href='logout.php'" class="btn btn-outline-light" aria-label="Sair">
            <i class="bi bi-box-arrow-right" alt="Ícone de sair"></i>
        </button>
    </header>

    <div class="container my-4">
        <h1 class="wellcome-title h3 mb-4 "><?php echo "Bem-vindo, {$clinicName}"; ?></h1>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center ">Administradores</h5>
                        <p class="card-text text-center"><strong>5</strong> Administradores</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Consultas</h5>
                        <p class="card-text text-center"><strong>120</strong> Consultas agendadas</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pacientes</h5>
                        <p class="card-text text-center"><strong>300</strong> Pacientes registrados</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Receitas</h5>
                        <p class="card-text text-center"><strong>R$ 15.000</strong> em receitas mensais</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <h4 class="text-secondary">Acesso rápido</h4>
                <div class="d-flex justify-content-start gap-3 flex-wrap">
                    <a href="adminMasterView.php" class="btn btn-outline-primary d-flex align-items-center">
                        <i class="bi bi-gear-fill me-2"></i>Administradores
                    </a>
                    <a href="adminDoctorView.php" class="btn btn-outline-primary d-flex align-items-center">
                        <i class="bi bi-person-fill me-2"></i>Médicos
                    </a>
                    <a href="adminPatientsView.php" class="btn btn-outline-primary d-flex align-items-center">
                        <i class="bi bi-person-badge me-2"></i>Pacientes
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <h4 class="text-secondary">Resumo das Atividades Recentes</h4>
                <div class="alert alert-info">
                    <strong>Nota:</strong> Não há novas atividades para mostrar.
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>