<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SmarterMaint - <?=$titulo;?></title>
  <meta name="robots" content="index, follow">
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar-brand {
      font-weight: bold;
    }
    .sidebar {
      height: 100vh;
      background: #ffffff;
      box-shadow: 2px 0 5px rgba(0,0,0,0.05);
    }
    .sidebar a {
      color: #333;
      padding: 10px 20px;
      display: block;
      border-radius: 8px;
      transition: background 0.2s;
    }
    .sidebar a:hover {
      background: #f1f1f1;
      text-decoration: none;
    }
    .main-content {
      margin-left: 220px;
      padding: 2rem;
    }
    a{
      text-decoration: none;
    }
  </style>
</head>
<body>

<div class="d-flex">
  <!-- Sidebar -->
  <div class="sidebar p-3 position-fixed" style="width: 220px;">
    
    <h5 class="mb-4"><i class="bi bi-tools me-2"></i>SmarterMaint</h5>
    <a class="<?=($page == 'dashboard')? 'text-primary':'';?>" href="<?=$base;?>/dashboard"><i class="bi bi-house me-2"></i>Dashboard</a>
    <a class="<?=($page == 'manutencoes')? 'text-primary':'';?>" href="<?=$base;?>/manutencoes"><i class="bi bi-hammer me-2"></i>Manutenções</a>
    <a class="<?=($page == 'instalacoes')? 'text-primary':'';?>" href="<?=$base;?>/instalacoes"><i class="bi bi-building me-2"></i>Instalações</a>
    <hr>
    <a href="<?=$base;?>/logout" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i>Sair</a>
    <hr>
    <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Apoie meu trabalho', '#005eff', 'C0C31G8E2D');kofiwidget2.draw();</script> 
  </div>

  <!-- Main Content -->
  <div class="main-content flex-grow-1">
