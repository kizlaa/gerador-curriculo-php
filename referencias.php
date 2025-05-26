<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomes    = $_POST['nomes']    ?? [];
    $contatos = $_POST['contatos'] ?? [];
    $relacoes = $_POST['relacoes'] ?? [];

    $lista = [];
    foreach ($nomes as $i => $n) {
        $nome   = trim($n);
        $cont   = trim($contatos[$i] ?? '');
        $rel    = trim($relacoes[$i] ?? '');
        if ($nome === '' && $cont === '' && $rel === '') {
            continue;
        }
        $lista[] = ['nome'=>$nome,'contato'=>$cont,'relacao'=>$rel];
    }
    $_SESSION['referencias'] = $lista;
    header('Location: visualizar.php');
    exit;
}

$refs = empty($_SESSION['referencias'] ?? [])
    ? [['nome'=>'','contato'=>'','relacao'=>'']]
    : $_SESSION['referencias'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etapa 5 – Referências Pessoais</title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
</head>
<body>
  <div class="container py-4">
    <ul class="nav nav-pills mb-4">
      <li class="nav-item"><a class="nav-link disabled">1. Dados</a></li>
      <li class="nav-item"><a class="nav-link disabled">2. Formação</a></li>
      <li class="nav-item"><a class="nav-link disabled">3. Experiência</a></li>
      <li class="nav-item"><a class="nav-link disabled">4. Habilidades</a></li>
      <li class="nav-item"><span class="nav-link active">5. Referências</span></li>
      <li class="nav-item"><span class="nav-link disabled">6. Visualizar</span></li>
    </ul>

    <h2>Referências Pessoais</h2>
    <form action="referencias.php" method="post">
      <div id="referencias">
        <?php foreach ($refs as $r): ?>
          <div class="border p-3 mb-3 referencia-item">
            <div class="mb-2">
              <label class="form-label">Nome</label>
              <input type="text" name="nomes[]" class="form-control" 
                     value="<?= htmlspecialchars($r['nome']) ?>">
            </div>
            <div class="mb-2">
              <label class="form-label">Contato (telefone/email)</label>
              <input type="text" name="contatos[]" class="form-control" 
                     value="<?= htmlspecialchars($r['contato']) ?>">
            </div>
            <div class="mb-2">
              <label class="form-label">Relação</label>
              <input type="text" name="relacoes[]" class="form-control" 
                     placeholder="e.g. Ex-chefe, Colega de curso"
                     value="<?= htmlspecialchars($r['relacao']) ?>">
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <button type="button" id="add-referencia" class="btn btn-secondary btn-sm mb-4">
        + Referência
      </button>

      <div class="d-flex justify-content-between">
        <a href="habilidades.php" class="btn btn-outline-secondary">&laquo; Voltar</a>
        <button type="submit" class="btn btn-primary">Próximo &raquo;</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
  <script>
    // adiciona um novo bloco de referência
    $(function(){
      $('#add-referencia').on('click', function(){
        const novo = $('.referencia-item').first().clone();
        novo.find('input').val('');
        $('#referencias').append(novo);
      });
    });
  </script>
</body>
</html>
