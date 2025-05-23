<?php
session_start();

// Se veio POST, salva na sessão e segue para Experiência
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = $_POST['formacoes'] ?? [];
    // limpa valores vazios e espaços
    $_SESSION['formacoes'] = array_values(array_filter(array_map('trim', $raw), fn($v)=>$v!==''));
    header('Location: experiencia.php');
    exit;
}

// Se já houver sessão, usa-a, senão inicia com um campo vazio
$formacoes = $_SESSION['formacoes'] ?? [''];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etapa 2 – Formação Acadêmica</title>
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
      <li class="nav-item"><span class="nav-link active">2. Formação</span></li>
      <li class="nav-item"><span class="nav-link disabled">3. Experiência</span></li>
      <li class="nav-item"><span class="nav-link disabled">4. Habilidades</span></li>
      <li class="nav-item"><span class="nav-link disabled">5. Referências</span></li>
      <li class="nav-item"><span class="nav-link disabled">6. Visualizar</span></li>
    </ul>

    <h2>Formação Acadêmica</h2>
    <form action="formacao.php" method="post">
      <div id="formacoes">
        <?php foreach ($formacoes as $f): ?>
          <div class="mb-3 formacao-item">
            <label class="form-label">Formação</label>
            <input 
              type="text" 
              name="formacoes[]" 
              class="form-control" 
              placeholder="Curso / Instituição / Ano" 
              value="<?= htmlspecialchars($f) ?>"
            >
          </div>
        <?php endforeach; ?>
      </div>
      <button type="button" id="add-formacao" class="btn btn-secondary btn-sm mb-4">
        + Formação
      </button>
      <div class="d-flex justify-content-between">
        <a href="dados.php" class="btn btn-outline-secondary">&laquo; Voltar</a>
        <button type="submit" class="btn btn-primary">Próximo &raquo;</button>
      </div>
    </form>
  </div>

  <!-- jQuery e Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
  <script>
    $(function(){
      $('#add-formacao').on('click', function(){
        const novo = $('.formacao-item').first().clone();
        novo.find('input').val('');
        $('#formacoes').append(novo);
      });
    });
  </script>
</body>
</html>
