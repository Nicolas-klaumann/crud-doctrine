<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Detalhes do Contato</title>
</head>
<body>
  <h1>Detalhes do Contato</h1>

  <p><strong>ID:</strong> <?= $contato->getId() ?></p>
  <p><strong>Tipo:</strong> <?= $contato->getTipo() ? "Telefone" : "Email" ?></p>
  <p><strong>Descrição:</strong> <?= $contato->getDescricao() ?></p>
  <p><strong>Pessoa:</strong> <?= $contato->getPessoa()->getNome() ?></p>

  <a href="/contato">Voltar</a>
</body>
</html>
