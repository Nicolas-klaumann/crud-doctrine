<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Detalhes da Pessoa</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
  <h1>Detalhes da Pessoa</h1>

  <table>
    <tr>
      <th>ID</th>
      <td><?= $pessoa->getId() ?></td>
    </tr>
    <tr>
      <th>Nome</th>
      <td><?= $pessoa->getNome() ?></td>
    </tr>
    <tr>
      <th>CPF</th>
      <td><?= $pessoa->getCpf() ?></td>
    </tr>
  </table>

  <p>
    <a href="/pessoa/<?= $pessoa->getId() ?>/edit">Editar</a> | 
    <a href="/pessoa/<?= $pessoa->getId() ?>/delete" onclick="return confirm('Deseja excluir?')">Excluir</a> | 
    <a href="/pessoa">Voltar</a>
  </p>
</div>
</body>
</html>
