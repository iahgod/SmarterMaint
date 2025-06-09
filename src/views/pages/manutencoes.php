<?=$render('pages/partials/header', ['titulo' => $titulo, 'page'=>'manutencoes']);?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><?=$titulo?></h2>
    <a href="<?=$base;?>/manutencao/novo" class="btn btn-primary">
      <i class="bi bi-plus-circle me-1"></i> Nova Manutenção
    </a>
  </div>

  <!-- Tabela de ultimas manutenções -->
  <div class="card shadow-sm border-0">

    <?php if (isset($_SESSION['flash']) && $_SESSION['flash'] != ""): ?>
          <div class="alert alert-<?= explode('@', $_SESSION['flash'])[0]; ?>">
              <?= explode('@', $_SESSION['flash'])[1]; ?>
          </div>
    <?php endif; ?>
    
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Manutenções</h5>
    </div>
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Instalação</th>
            <th>Data Prevista</th>
            <th>Status</th>
            <th>Técnico</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($manutencoes as $manutencao): ?>
            <tr>
              <td><?= $manutencao['instalacao'] ?></td>
              <td><?= date('d/m/Y', strtotime($manutencao['data'])) ?></td>
              <td>
                <?php if ($manutencao['status'] === 'Concluída'): ?>
                  <span class="badge bg-success">Concluída</span>
                <?php elseif ($manutencao['status'] === 'Atrasada'): ?>
                  <span class="badge bg-danger">Atrasada</span>
                <?php elseif ($manutencao['status'] === 'Em andamento'): ?>
                  <span class="badge bg-primary">Em andamento</span>
                <?php else: ?>
                  <span class="badge bg-warning text-dark">Aberta</span>
                <?php endif; ?>
              </td>
              <td><?= $manutencao['tecnico'] ?></td>
              <td><a href="<?=$base;?>/manutencao/detalhes/<?= $manutencao['id'] ?>" class="btn btn-sm btn-outline-primary">Detalhes</a></td>
            </tr>
          <?php endforeach; ?>

          <?php if (empty($manutencoes)): ?>
            <tr>
              <td colspan="5" class="text-center text-muted py-4">Nenhuma manutenção encontrada.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?=$render('pages/partials/footer', []);?>
