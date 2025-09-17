<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Detalhes do Contato</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Detalhes do Contato</h1>

    <div class="card">
      <p><strong>ID:</strong> <?= $contato->getId() ?></p>
      <p><strong>Tipo:</strong> <?= $contato->getTipo() ? "Telefone" : "Email" ?></p>
      <p><strong>Descrição:</strong> <?= $contato->getDescricao() ?></p>
      <p><strong>Pessoa:</strong> <?= $contato->getPessoa()->getNome() ?></p>
    </div>

    <p><a href="/contato" class="btn-secondary">Voltar</a></p>
  </div>
</body>
</html>
