<?=$render('pages/partials/header', ['titulo' => $titulo, 'page'=>'instalacoes']);?>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><?=$titulo?></h2>
    <a href="<?=$base;?>/instalacao/novo" class="btn btn-primary">
      <i class="bi bi-plus-circle me-1"></i> Nova Instalação
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
      <h5 class="mb-0">Instalações</h5>
    </div>
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Nome</th>
            <th>Setor</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($instalacoes as $instalacao): ?>
            <tr>
              <td><?= $instalacao['nome'] ?></td>
              <td><?= $instalacao['setor'] ?></td>
              <td><a href="<?=$base;?>/instalacao/detalhes/<?= $instalacao['id'] ?>" class="btn btn-sm btn-outline-primary">Detalhes</a></td>
            </tr>
          <?php endforeach; ?>

          <?php if (empty($instalacoes)): ?>
            <tr>
              <td colspan="5" class="text-center text-muted py-4">Nenhuma instalação encontrada.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?=$render('pages/partials/footer', []);?>
