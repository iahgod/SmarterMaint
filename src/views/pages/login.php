<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Autenticação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }
    .auth-container {
      max-width: 400px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .auth-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .toggle-view {
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="auth-container">
    
    <?php if (isset($_SESSION['flash']) && $_SESSION['flash'] != ""): ?>
        <div class="alert alert-<?= explode('@', $_SESSION['flash'])[0]; ?>">
            <?= explode('@', $_SESSION['flash'])[1]; ?>
        </div>
    <?php endif; ?>

  <!-- LOGIN -->
  <div id="login-form">
    <h2>Login</h2>
    <form action="<?=$base;?>/login" method="post">
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail">
      </div>
      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="password" class="form-control" placeholder="Digite sua senha">
      </div>
      <button type="submit" class="btn btn-primary w-100">Entrar</button>
      <div class="toggle-view">
        <a href="#" onclick="mostrar('forgot-form')">Esqueceu a senha?</a><br>
        <a href="#" onclick="mostrar('register-form')">Criar conta</a>
      </div>
    </form>
  </div>

  <!-- ESQUECEU A SENHA -->
  <div id="forgot-form" style="display: none;">
    <h2>Recuperar Senha</h2>
    <form action="<?=$base;?>/password-reset" method="post">
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail">
      </div>
      <button type="submit" class="btn btn-warning w-100">Enviar recuperação</button>
      <div class="toggle-view">
        <a href="#" onclick="mostrar('login-form')">Voltar ao login</a>
      </div>
    </form>
  </div>

  <!-- CADASTRO -->
  <div id="register-form" style="display: none;">
    <h2>Cadastro</h2>
    <form action="<?=$base;?>/sigin" method="post">
      <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" placeholder="Digite seu nome">
      </div>
      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail">
      </div>
      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="password" class="form-control" placeholder="Digite uma senha">
      </div>
      <div class="mb-3">
        <label class="form-label">Confirmar Senha</label>
        <input type="password" name="password_confirm" class="form-control" placeholder="Confirme a senha">
      </div>
      <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
      <div class="toggle-view">
        <a href="#" onclick="mostrar('login-form')">Voltar ao login</a>
      </div>
    </form>
  </div>
</div>

<script>
  function mostrar(formId) {
    document.querySelectorAll('.auth-container > div').forEach(el => el.style.display = 'none');
    document.getElementById(formId).style.display = 'block';
  }
</script>

</body>
</html>

<?php 
$_SESSION['flash'] = ""; // Limpa a mensagem de flash após exibição
?>
