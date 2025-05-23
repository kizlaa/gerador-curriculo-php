<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

// Se vier via POST, salva na sessão e redireciona
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nome']      = trim($_POST['nome']      ?? '');
    $_SESSION['nascimento']= $_POST['nascimento'] ?? '';
    $_SESSION['idade']     = $_POST['idade']      ?? '';
    $_SESSION['email']     = trim($_POST['email']     ?? '');
    $_SESSION['telefone']  = trim($_POST['telefone']  ?? '');
    $_SESSION['resumo']    = trim($_POST['resumo']    ?? '');
    // foto (nome temporário, não salvamos arquivo físico por ora)
    $_SESSION['foto_name'] = $_FILES['foto']['name'] ?? '';
    // não salvamos o upload na pasta (pode ser implementado depois)
    header('Location: formacao.php');
    exit;
}

// Se já houver dados na sessão, pré-preenche
$nome       = $_SESSION['nome']      ?? '';
$nascimento = $_SESSION['nascimento']?? '';
$idade      = $_SESSION['idade']     ?? '';
$email      = $_SESSION['email']     ?? '';
$telefone   = $_SESSION['telefone']  ?? '';
$resumo     = $_SESSION['resumo']    ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etapa 1 – Dados Pessoais</title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
</head>
<body>
  <div class="container py-4">
    <!-- Nav de etapas -->
    <ul class="nav nav-pills mb-4">
      <li class="nav-item"><span class="nav-link active">1. Dados</span></li>
      <li class="nav-item"><span class="nav-link disabled">2. Formação</span></li>
      <li class="nav-item"><span class="nav-link disabled">3. Experiência</span></li>
      <li class="nav-item"><span class="nav-link disabled">4. Habilidades</span></li>
      <li class="nav-item"><span class="nav-link disabled">5. Referências</span></li>
      <li class="nav-item"><span class="nav-link disabled">6. Visualizar</span></li>
    </ul>

    <h2>Dados Pessoais</h2>
    <form action="dados.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nome"     class="form-label">Nome completo</label>
        <input type="text"    id="nome" name="nome"         class="form-control" value="<?= htmlspecialchars($nome) ?>" required>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="nascimento" class="form-label">Data de nascimento</label>
          <input type="date"      id="nascimento" name="nascimento"
                 class="form-control" value="<?= htmlspecialchars($nascimento) ?>" required>
        </div>
        <div class="col-md-2 mb-3">
          <label for="idade"      class="form-label">Idade</label>
          <input type="number"    id="idade" name="idade"      class="form-control" value="<?= htmlspecialchars($idade) ?>" readonly>
        </div>
      </div>
      <div class="mb-3">
        <label for="email"     class="form-label">Email</label>
        <input type="email"    id="email" name="email"       class="form-control" value="<?= htmlspecialchars($email) ?>" required>
      </div>
      <div class="mb-3">
        <label for="telefone"  class="form-label">Telefone</label>
        <input type="tel"      id="telefone" name="telefone" class="form-control" value="<?= htmlspecialchars($telefone) ?>" required>
      </div>
      <div class="mb-3">
        <label for="foto"      class="form-label">Foto (jpg/png)</label>
        <input type="file"     id="foto" name="foto"         class="form-control" accept="image/*">
      </div>
      <div class="mb-3">
        <label for="resumo"    class="form-label">Resumo Profissional</label>
        <textarea id="resumo" name="resumo" class="form-control" rows="4"><?= htmlspecialchars($resumo) ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Próximo &raquo;</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Cálculo de idade instantâneo
    $(function(){
      $('#nascimento').on('change', function(){
        const nasc = new Date(this.value), hoje = new Date();
        let id = hoje.getFullYear() - nasc.getFullYear();
        const m = hoje.getMonth() - nasc.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) id--;
        $('#idade').val(id);
      });
    });
  </script>
</body>
</html>
