<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = $_POST['habilidades'] ?? [];
    $_SESSION['habilidades'] = array_values(
        array_filter(
            array_map('trim', $raw),
            fn($v) => $v !== ''
        )
    );
    header('Location: referencias.php');
    exit;
}

$habils = empty($_SESSION['habilidades'] ?? [])
    ? ['']
    : $_SESSION['habilidades'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etapa 4 – Habilidades</title>
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
      <li class="nav-item"><span class="nav-link active">4. Habilidades</span></li>
      <li class="nav-item"><span class="nav-link disabled">5. Referências</span></li>
      <li class="nav-item"><span class="nav-link disabled">6. Visualizar</span></li>
    </ul>

    <h2>Habilidades</h2>
    <form action="habilidades.php" method="post">
      <div id="habilidades">
        <?php foreach ($habils as $h): ?>
          <div class="mb-3 habilidade-item">
            <label class="form-label">Habilidade</label>
            <input 
              type="text" 
              name="habilidades[]" 
              class="form-control" 
              placeholder="Descreva uma habilidade" 
              value="<?= htmlspecialchars($h) ?>"
            >
          </div>
        <?php endforeach; ?>
      </div>

      <button type="button" id="add-habilidade" class="btn btn-secondary btn-sm mb-4">
        + Habilidade
      </button>

      <div class="d-flex justify-content-between">
        <a href="experiencia.php" class="btn btn-outline-secondary">&laquo; Voltar</a>
        <button type="submit" class="btn btn-primary">Próximo &raquo;</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
  <script>
    // adiciona um novo campo de habilidade
    $(function(){
      $('#add-habilidade').click(function(){
        const novo = $('.habilidade-item').first().clone();
        novo.find('input').val('');
        $('#habilidades').append(novo);
      });
    });
  </script>
</body>
</html>
