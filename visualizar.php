<?php
session_start();

if (
    empty($_SESSION['nome'])       ||
    empty($_SESSION['formacoes'])  ||
    empty($_SESSION['experiencias']) ||
    empty($_SESSION['habilidades'])  ||
    empty($_SESSION['referencias'])
) {
    header('Location: dados.php');
    exit;
}

$nome         = $_SESSION['nome'];
$nascimento   = $_SESSION['nascimento'];
$idade        = $_SESSION['idade'];
$email        = $_SESSION['email'];
$telefone     = $_SESSION['telefone'];
$resumo       = $_SESSION['resumo'];
$formacoes    = $_SESSION['formacoes'];
$experiencias = $_SESSION['experiencias'];
$habilidades  = $_SESSION['habilidades'];
$referencias  = $_SESSION['referencias'];

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
  <title>Etapa 6 – Visualizar Currículo</title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
</head>
<body>
  <div class="container py-4">
    <ul class="nav nav-pills mb-4">
      <li class="nav-item"><a href="dados.php"       class="nav-link">1. Dados</a></li>
      <li class="nav-item"><a href="formacao.php"   class="nav-link">2. Formação</a></li>
      <li class="nav-item"><a href="experiencia.php"class="nav-link">3. Experiência</a></li>
      <li class="nav-item"><a href="habilidades.php"class="nav-link">4. Habilidades</a></li>
      <li class="nav-item"><a href="referencias.php"class="nav-link">5. Referências</a></li>
      <li class="nav-item"><span class="nav-link active">6. Visualizar</span></li>
    </ul>

    <h2>Currículo de <?= htmlspecialchars($nome) ?></h2>

    <ul class="list-group mb-4">
      <li class="list-group-item"><strong>Nome completo:</strong> <?= htmlspecialchars($nome) ?></li>
      <li class="list-group-item"><strong>Data de nascimento:</strong> <?= $dataFormat ?></li>
      <li class="list-group-item"><strong>Idade:</strong> <?= htmlspecialchars($idade) ?> anos</li>
      <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
      <li class="list-group-item"><strong>Telefone:</strong> <?= htmlspecialchars($telefone) ?></li>
    </ul>

    <?php if ($resumo !== ''): ?>
      <h4>Resumo Profissional</h4>
      <p><?= nl2br(htmlspecialchars($resumo)) ?></p>
    <?php endif; ?>

    <?php if (!empty($formacoes)): ?>
      <h4>Formação Acadêmica</h4>
      <ul class="list-group mb-4">
        <?php foreach ($formacoes as $f): ?>
          <li class="list-group-item"><?= htmlspecialchars($f) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($experiencias)): ?>
      <h4>Experiência Profissional</h4>
      <ul class="list-group mb-4">
        <?php foreach ($experiencias as $item): ?>
          <li class="list-group-item">
            <strong><?= htmlspecialchars($item['empresa'] ?: '-') ?></strong><br>
            <?= htmlspecialchars($item['cargo'] ?: '-') ?> • <?= htmlspecialchars($item['periodo'] ?: '-') ?><br>
            <em><?= nl2br(htmlspecialchars($item['descricao'])) ?></em>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($habilidades)): ?>
      <h4>Habilidades</h4>
      <ul class="list-group list-group-horizontal flex-wrap mb-4">
        <?php foreach ($habilidades as $h): ?>
          <li class="list-group-item"><?= htmlspecialchars($h) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($referencias)): ?>
      <h4>Referências Pessoais</h4>
      <ul class="list-group mb-4">
        <?php foreach ($referencias as $r): ?>
          <li class="list-group-item">
            <strong><?= htmlspecialchars($r['nome'] ?: '-') ?></strong><br>
            <?= htmlspecialchars($r['contato'] ?: '-') ?><br>
            <small><?= htmlspecialchars($r['relacao'] ?: '-') ?></small>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <div class="d-flex justify-content-between">
      <a href="referencias.php" class="btn btn-outline-secondary">&laquo; Voltar</a>
      <button class="btn btn-primary" onclick="window.print()">Imprimir / Baixar currículo</button>
    </div>
  </div>

  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  ></script>
</body>
</html>

