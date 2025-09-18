<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pessoas</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
  <body>
    <div class="container">
      <h1>Lista de Pessoas</h1>

      <p><a href="/contato" class="btn-secondary">Voltar para Contatos</a></p>

      <form method="GET" action="/pessoa">
          <input type="text" name="nome" placeholder="Pesquisar por nome">
          <button type="submit">Buscar</button>
      </form>

      <p><a href="/pessoa/create">+ Nova Pessoa</a></p>

      <table>
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
            <td class="actions">
              <a href="/pessoa/<?= $pessoa->getId() ?>">Ver</a>
              <a href="/pessoa/<?= $pessoa->getId() ?>/edit">Editar</a>
              <a href="/pessoa/<?= $pessoa->getId() ?>/delete" onclick="return confirm('Deseja excluir?')">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>
</html>
