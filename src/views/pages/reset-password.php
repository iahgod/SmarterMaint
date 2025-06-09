<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mudar a senha</title>
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

  <!-- NOVA SENHA -->
  <div id="newpass-form">
    <h2>Nova Senha</h2>
    <form action="<?=$base;?>/new-password" method="post">
      <div class="mb-3">
        <label class="form-label">Nova Senha</label>
        <input type="password" name="new_password" class="form-control" placeholder="Nova senha">
      </div>
      <div class="mb-3">
        <label class="form-label">Confirmar Nova Senha</label>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirme a senha">
      </div>
      <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? '', ENT_QUOTES); ?>">
      <button type="submit" class="btn btn-success w-100">Atualizar senha</button>
    </form>
  </div>

</div>

</body>
</html>

<?php 
$_SESSION['flash'] = ""; // Limpa a mensagem de flash após exibição
?>
