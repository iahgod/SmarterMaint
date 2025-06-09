<?=$render('pages/partials/header', ['titulo' => $titulo, 'page'=>'manutencoes']);?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Nova Manutenção</h2>
    <a href="<?=$base;?>/manutencoes" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Voltar
    </a>
  </div>

  <form action="<?=$base;?>/manutencao/detalhes" method="post">
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
          <option value="<?=$manutencao['instalacao_id'];?>" selected><?=$manutencao['instalacao'];?></option>
          <?php foreach($instalacoes as $instalacao): ?>
            <?php if($instalacao['id'] != $manutencao['instalacao_id']):?>
            <option value="<?= $instalacao['id'] ?>"><?= $instalacao['nome'] ?></option>
            <?php endif;?>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Status -->
      <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
          <option value="<?=$manutencao['status'];?>" selected><?=$manutencao['status'];?></option>
          <?php foreach(['Aberta', 'Em andamento','Concluída'] as $status): ?>

            <?php if($status != $manutencao['status']):?>
              <option value="<?= $status ?>"><?= $status ?></option>
            <?php endif;?>
            
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
          <option value="<?=$manutencao['tipo'];?>" selected><?=$manutencao['tipo'];?></option>
          <?php foreach(['Preventiva', 'Corretiva'] as $tipo): ?>

            <?php if($tipo != $manutencao['tipo']):?>
               <option value="<?= $tipo ?>"><?= $tipo ?></option>
            <?php endif;?>
           
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Título -->
      <div class="col-md-8">
        <label for="titulo" class="form-label">Título da Manutenção</label>
        <input type="text" name="titulo" id="titulo" value="<?=$manutencao['titulo'];?>" class="form-control" placeholder="Ex: Troca de filtro do ar condicionado" required>
      </div>

      <!-- Data prevista -->
      <div class="col-md-2">
        <label for="data_prevista" class="form-label">Data Prevista</label>
        <input type="date" name="data_prevista" id="data_prevista" class="form-control" value="<?=$manutencao['data_prevista'];?>" required>
      </div>

      <!-- Descrição -->
      <div class="col-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="4" placeholder="Descreva o problema, causa ou ação a ser tomada..." required><?=$manutencao['descricao'];?></textarea>
      </div>

      <input type="hidden" name="id" value="<?=$manutencao['id'];?>">

      <!-- Botão -->
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i> Atualizar Manutenção
        </button>
      </div>

        <div class="container my-4">
          <h4 class="mb-4 fw-bold">Linha do Tempo da Manutenção</h4>
          <div class="timeline position-relative"style="overflow-y: scroll;height:300px;">

            <?php foreach($logs as $log): ?>
              <div class="timeline-item mb-4 position-relative ps-4 border-start border-3 border-primary">
                <div class="small text-muted"><?= date('d/m/Y H:i', strtotime($log['data_log'])) ?></div>
                <div><?= $log['acao'] ?></div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
    </div>
  </form>



</div>

<?=$render('pages/partials/footer', []);?>
