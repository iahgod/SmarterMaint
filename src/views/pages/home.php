<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
   <!-- Título e descrição -->
  <title>SmarterMaint - Sistema Inteligente de Manutenções Prediais</title>
  <meta name="description" content="Gerencie manutenções prediais com eficiência e tecnologia usando o SmarterMaint. Interface intuitiva, controle total e histórico de ações.">

  <!-- Palavras-chave para SEO -->
  <meta name="keywords" content="manutenção predial, sistema de manutenção, SmarterMaint, gestão predial, manutenção inteligente">
  <meta name="author" content="SmarterMaint">

  <!-- Open Graph para redes sociais -->
  <meta property="og:title" content="SmarterMaint - Sistema de Manutenção Predial">
  <meta property="og:description" content="Solução completa para controle e histórico de manutenções prediais.">
  <meta property="og:image" content="<?=$base;?>/assets/img/logo.png">
  <meta property="og:url" content="https://smartermaint.iahgod.com.br">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="pt_BR">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="SmarterMaint">
  <meta name="twitter:description" content="Solução completa para manutenção predial.">
  <meta name="twitter:image" content="<?=$base;?>/assets/img/logo.png">

  <!-- Favicon -->
  <link rel="icon" href="<?=$base;?>/assets/img/logo.png" type="image/x-icon">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Header/Navbar -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#">SmarterMaint</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="#">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=$base;?>/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=$base;?>/login">Login / Criar conta</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Conteúdo Principal -->
  <main class="flex-fill py-5">
    <div class="container">

      <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">SmarterMaint</h1>
        <p class="lead text-muted">Sistema Inteligente de Controle de Manutenção Predial</p>
      </div>

      <!-- Descrição -->
      <div class="row g-4 mb-5">
        <div class="col-lg-6">
          <h4 class="fw-bold">📋 O que é o SmarterMaint?</h4>
          <p>
            O <strong>SmarterMaint</strong> é uma plataforma moderna para gerenciar manutenções preventivas e corretivas em prédios, empresas e instituições. Ideal para ILPIs, hospitais, condomínios e qualquer organização que precisa rastrear e acompanhar atividades de manutenção com eficiência.
          </p>
          <p><b>Totalmente grátis!</b></p>
          <a href="<?=$base;?>/login"><button class="btn btn-primary">Comece agora!</button></a>
        </div>
        <div class="col-lg-6">
          <img src="<?=$base;?>/assets/img/home.png" alt="Ilustração de manutenção" class="img-fluid rounded shadow-sm">
        </div>
      </div>

      <!-- Recursos -->
      <div class="row g-4 text-center">
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <i class="bi bi-ui-checks-grid display-5 text-primary"></i>
              <h5 class="card-title mt-3">Dashboard Dinâmico</h5>
              <p class="card-text">Visualize o status das manutenções em tempo real com atalhos para ações rápidas.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <i class="bi bi-tools display-5 text-primary"></i>
              <h5 class="card-title mt-3">Gestão de Manutenções</h5>
              <p class="card-text">Crie, edite e acompanhe manutenções preventivas e corretivas com facilidade.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <i class="bi bi-clock-history display-5 text-primary"></i>
              <h5 class="card-title mt-3">Linha do Tempo</h5>
              <p class="card-text">Tenha um histórico completo das ações realizadas em cada manutenção.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-light text-center py-3 mt-auto border-top">
    <div class="container">
      <small class="text-muted">SmarterMaint &copy; <?= date('Y') ?> - Desenvolvido por iahgod</small>
    </div>
  </footer>

  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
