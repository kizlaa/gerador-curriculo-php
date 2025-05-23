<?php
session_start();

// Ao submeter, guarda em $_SESSION e vai para Habilidades
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empresas   = $_POST['empresas']   ?? [];
    $cargos     = $_POST['cargos']     ?? [];
    $periodos   = $_POST['periodos']   ?? [];
    $descricoes = $_POST['descricoes'] ?? [];

    $lista = [];
    foreach ($empresas as $i => $emp) {
        $e = trim($emp);
        $c = trim($cargos[$i]     ?? '');
        $p = trim($periodos[$i]   ?? '');
        $d = trim($descricoes[$i] ?? '');
        if ($e === '' && $c === '' && $p === '' && $d === '') {
            continue;
        }
        $lista[] = ['empresa'=>$e,'cargo'=>$c,'periodo'=>$p,'descricao'=>$d];
    }

    $_SESSION['experiencias'] = $lista;
    header('Location: habilidades.php');
    exit;
}

// Se a sessão não existir ou estiver vazia, garante um bloco padrão
if (empty($_SESSION['experiencias'] ?? [])) {
    $expSess = [['empresa'=>'','cargo'=>'','periodo'=>'','descricao'=>'']];
} else {
    $expSess = $_SESSION['experiencias'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etapa 3 – Experiência Profissional</title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
</head>
<body>
  <div class="container py-4">
    <!-- Nav de etapas -->
    <ul class="nav nav-pills mb-4">
      <li class="nav-item"><a class="nav-link disabled">1. Dados</a></li>
      <li class="nav-item"><a class="nav-link disabled">2. Formação</a></li>
      <li class="nav-item"><span class="nav-link active">3. Experiência</span></li>
      <li class="nav-item"><span class="nav-link disabled">4. Habilidades</span></li>
      <li class="nav-item"><span class="nav-link disabled">5. Referências</span></li>
      <li class="nav-item"><span class="nav-link disabled">6. Visualizar</span></li>
    </ul>

    <h2>Experiência Profissional</h2>
    <form action="experiencia.php" method="post">
      <div id="experiencias">
        <?php foreach ($expSess as $item): ?>
        <div class="border p-3 mb-3 experiencia-item">
          <div class="mb-2">
            <label class="form-label">Empresa</label>
            <input type="text" name="empresas[]" class="form-control" 
                   value="<?= htmlspecialchars($item['empresa']) ?>">
          </div>
          <div class="mb-2">
            <label class="form-label">Cargo</label>
            <input type="text" name="cargos[]" class="form-control" 
                   value="<?= htmlspecialchars($item['cargo']) ?>">
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <label class="form-label">Período</label>
              <input type="text" name="periodos[]" class="form-control" 
                     placeholder="Ex: Jan/2020 - Dez/2021"
                     value="<?= htmlspecialchars($item['periodo']) ?>">
            </div>
          </div>
          <div class="mb-2">
            <label class="form-label">Descrição</label>
            <textarea name="descricoes[]" class="form-control" rows="2"><?= htmlspecialchars($item['descricao']) ?></textarea>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <button type="button" id="add-experiencia" class="btn btn-secondary btn-sm mb-4">
        + Experiência
      </button>

      <div class="d-flex justify-content-between">
        <a href="formacao.php" class="btn btn-outline-secondary">&laquo; Voltar</a>
        <button type="submit" class="btn btn-primary">Próximo &raquo;</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
  <script>
    $(function(){
      $('#add-experiencia').click(function(){
        const novo = $('.experiencia-item').first().clone();
        novo.find('input, textarea').val('');
        $('#experiencias').append(novo);
      });
    });
  </script>
</body>
</html>
