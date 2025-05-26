<?php
date_default_timezone_set('America/Sao_Paulo');

$nome         = htmlspecialchars($_POST['nome']       ?? '');
$nascimento   =     $_POST['nascimento'] ?? '';
$idade        =     $_POST['idade']      ?? '';
$formacoes    =     $_POST['formacoes']   ?? [];
$experiencias =     $_POST['experiencias'] ?? [];
$habilidades  =     $_POST['habilidades']  ?? [];
$referencias  =     $_POST['referencias']  ?? [];

// formata data de Y-m-d para d/m/Y
function formatDate($data) {
    $d = DateTime::createFromFormat('Y-m-d', $data);
    return $d ? $d->format('d/m/Y') : '';
}
$dataFormat = formatDate($nascimento);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Currículo – <?= htmlspecialchars($nome) ?></title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
</head>
<body>
  <div class="container py-4">
    <h1 class="mb-4">Currículo de <?= htmlspecialchars($nome) ?></h1>

    <ul class="list-group mb-4">
      <li class="list-group-item"><strong>Nome completo:</strong> <?= htmlspecialchars($nome) ?></li>
      <li class="list-group-item"><strong>Data de nascimento:</strong> <?= $dataFormat ?></li>
      <li class="list-group-item"><strong>Idade:</strong> <?= htmlspecialchars($idade) ?> anos</li>
    </ul>

    <?php if (!empty($formacoes)): ?>
      <h3>Formação Acadêmica</h3>
      <ul class="list-group mb-4">
        <?php foreach ($formacoes as $f): 
          $f = trim(htmlspecialchars($f));
          if ($f === '') continue;
        ?>
          <li class="list-group-item"><?= $f ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($experiencias)): ?>
      <h3>Experiência Profissional</h3>
      <ul class="list-group mb-4">
        <?php foreach ($experiencias as $exp): 
          $exp = trim(htmlspecialchars($exp));
          if ($exp === '') continue;
        ?>
          <li class="list-group-item"><?= $exp ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($habilidades)): ?>
      <h3>Habilidades</h3>
      <ul class="list-group mb-4">
        <?php foreach ($habilidades as $h): 
          $h = trim(htmlspecialchars($h));
          if ($h === '') continue;
        ?>
          <li class="list-group-item"><?= $h ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($referencias)): ?>
      <h3>Referências Pessoais</h3>
      <ul class="list-group mb-4">
        <?php foreach ($referencias as $ref): 
          $ref = trim(htmlspecialchars($ref));
          if ($ref === '') continue;
        ?>
          <li class="list-group-item"><?= $ref ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <button class="btn btn-primary" onclick="window.print()">Imprimir / Baixar currículo</button>
  </div>

  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>
