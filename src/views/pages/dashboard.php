<?=$render('pages/partials/header', ['titulo' => $titulo, 'page'=>'dashboard']);?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Dashboard</h2>
    <a href="<?=$base;?>/manutencao/novo" class="btn btn-primary">
      <i class="bi bi-plus-circle me-1"></i> Nova Manutenção
    </a>
  </div>

  <div class="row g-4 mb-4">
    <!-- Card: Abertas -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm bg-warning text-white h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-uppercase">Abertas</h6>
              <h3 class="fw-bold"><?= $totalAbertas ?></h3>
            </div>
            <i class="bi bi-tools fs-2"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Card: Concluídas -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm bg-success text-white h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-uppercase">Concluídas</h6>
              <h3 class="fw-bold"><?= $totalConcluidas ?></h3>
            </div>
            <i class="bi bi-check-circle fs-2"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Card: Atrasadas -->
    <div class="col-md-4">
      <div class="card border-0 shadow-sm bg-danger text-white h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-uppercase">Atrasadas</h6>
              <h3 class="fw-bold"><?= $totalAtrasadas ?></h3>
            </div>
            <i class="bi bi-exclamation-triangle fs-2"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabela de ultimas manutenções -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Últimas Manutenções</h5>
      <a href="<?=$base;?>/manutencoes" class="btn btn-outline-secondary btn-sm">
        Ver todas <i class="bi bi-arrow-right"></i>
      </a>
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
          <?php foreach($ultimasManutencoes as $manutencao): ?>
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

          <?php if (empty($ultimasManutencoes)): ?>
            <tr>
              <td colspan="5" class="text-center text-muted py-4">Nenhuma manutenção recente encontrada.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?=$render('pages/partials/footer', []);?>
