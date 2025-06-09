<?=$render('pages/partials/header', ['titulo' => $titulo, 'page'=>'manutencoes']);?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Nova Manutenção</h2>
    <a href="<?=$base;?>/manutencoes" class="btn btn-outline-secondary">
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

      <!-- Instalação -->
      <div class="col-md-4">
        <label for="instalacao" class="form-label">Instalação</label>
        <select name="instalacao_id" id="instalacao" class="form-select" required>
          <option value="" selected disabled>Selecione uma instalação</option>
          <?php foreach($instalacoes as $instalacao): ?>
            <option value="<?= $instalacao['id'] ?>"><?= $instalacao['nome'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Status -->
      <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
          <option value="Aberta" selected>Aberta</option>
          <?php foreach(['Em andamento','Concluída'] as $status): ?>
            <option value="<?= $status ?>"><?= $status ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Técnico -->
      <div class="col-md-4">
        <label for="tecnico" class="form-label">Técnico Responsável</label>
        <select name="tecnico_id" id="tecnico" class="form-select" required>

            <option value="<?= $loggedUser->id ?>"><?= $loggedUser->nome ?></option>

        </select>
      </div>

      <!-- Tipo -->
      <div class="col-md-2">
        <label for="tipo" class="form-label">Tipo</label>
        <select name="tipo" id="tipo" class="form-select" required>
          <option value="" selected disabled>Selecione um tipo</option>
          <?php foreach(['Preventiva', 'Corretiva'] as $tipo): ?>
            <option value="<?= $tipo ?>"><?= $tipo ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Título -->
      <div class="col-md-8">
        <label for="titulo" class="form-label">Título da Manutenção</label>
        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ex: Troca de filtro do ar condicionado" required>
      </div>

      <!-- Data prevista -->
      <div class="col-md-2">
        <label for="data_prevista" class="form-label">Data Prevista</label>
        <input type="date" name="data_prevista" id="data_prevista" class="form-control" required>
      </div>

      <!-- Descrição -->
      <div class="col-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="4" placeholder="Descreva o problema, causa ou ação a ser tomada..." required></textarea>
      </div>

      <!-- Botão -->
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i> Salvar Manutenção
        </button>
      </div>
    </div>
  </form>
</div>

<?=$render('pages/partials/footer', []);?>
