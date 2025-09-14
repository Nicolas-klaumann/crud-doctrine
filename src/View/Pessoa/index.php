<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pessoas</title>
</head>
<body>
  <h1>Lista de Pessoas</h1>

  <form method="GET" action="/pessoas">
      <input type="text" name="nome" placeholder="Pesquisar por nome">
      <button type="submit">Buscar</button>
  </form>

  <a href="/pessoas/create">Nova Pessoa</a>

  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>CPF</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($pessoas as $pessoa): ?>
      <tr>
        <td><?= $pessoa->getId() ?></td>
        <td><?= $pessoa->getNome() ?></td>
        <td><?= $pessoa->getCpf() ?></td>
        <td>
          <a href="/pessoas/<?= $pessoa->getId() ?>">Ver</a> |
          <a href="/pessoas/<?= $pessoa->getId() ?>/edit">Editar</a> |
          <a href="/pessoas/<?= $pessoa->getId() ?>/delete" onclick="return confirm('Deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
