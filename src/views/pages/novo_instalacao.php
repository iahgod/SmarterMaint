<?=$render('pages/partials/header', ['titulo' => $titulo, 'page'=>'instalacoes']);?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Nova Instalação</h2>
    <a href="<?=$base;?>/instalacoes" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Voltar
    </a>
  </div>

  <form action="" method="post">
    <div class="row g-4">

      <?php if (isset($_SESSION['flash']) && $_SESSION['flash'] != ""): ?>
          <div class="alert alert-<?= explode('@', $_SESSION['flash'])[0]; ?>">
              <?= explode('@', $_SESSION['flash'])[1]; ?>
          </div>
      <?php endif; ?>
      
      <!-- Nome da Instalação -->
      <div class="col-md-8">
        <label for="nome" class="form-label">Nome da Instalação</label>
        <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex: Gerador Bloco A" required>
      </div>

      <!-- Nome do Setor -->
      <div class="col-md-4">
        <label for="setor" class="form-label">Setor</label>
        <input type="text" name="setor" id="setor" class="form-control" placeholder="Ex: Manutenção Predial" required>
      </div>

      <!-- Observações -->
      <div class="col-12">
        <label for="observacoes" class="form-label">Observações</label>
        <textarea name="observacoes" id="observacoes" class="form-control" rows="4" placeholder="Ex: Local com difícil acesso, equipamento antigo, etc."></textarea>
      </div>

      <!-- Botão -->
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-check-circle"></i> Salvar Instalação
        </button>
      </div>
    </div>
  </form>
</div>


<?=$render('pages/partials/footer', []);?>
