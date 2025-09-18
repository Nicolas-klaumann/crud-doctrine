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

    <table class="card">
      <tr>
        <th>ID</th>
        <td><?= $contato->getId() ?></td>
      </tr>
      <tr>
        <th>Tipo</th>
        <td><?= $contato->getTipo() ? "Telefone" : "Email" ?></td>
      </tr>
      <tr>
        <th>Descrição</th>
        <td><?= $contato->getDescricao() ?></td>
      </tr>
      <tr>
        <th>Pessoa</th>
        <td><?= $contato->getPessoa()->getNome() ?></td>
      </tr>
    </table>

    <p>
      <a href="/contato/<?= $contato->getId() ?>/edit">Editar</a> |
      <a href="/contato/<?= $contato->getId() ?>/delete" onclick="return confirm('Deseja excluir?')">Excluir</a> |
      <a href="/contato" class="btn-secondary">Voltar</a>
    </p>
  </div>
</body>
</html>
