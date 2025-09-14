<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Detalhes da Pessoa</title>
</head>
<body>
  <h1>Detalhes da Pessoa</h1>

  <p><strong>ID:</strong> <?= $pessoa->getId() ?></p>
  <p><strong>Nome:</strong> <?= $pessoa->getNome() ?></p>
  <p><strong>CPF:</strong> <?= $pessoa->getCpf() ?></p>

  <a href="/pessoas">Voltar</a>
</body>
</html>
