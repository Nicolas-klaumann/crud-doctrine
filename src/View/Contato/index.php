<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Contatos</title>
</head>
<body>
  <h1>Lista de Contatos</h1>

  <a href="/contato/create">Novo Contato</a>

  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Tipo</th>
      <th>Descrição</th>
      <th>Pessoa</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($contatos as $contato): ?>
      <tr>
        <td><?= $contato->getId() ?></td>
        <td><?= $contato->getTipo() ? "Telefone" : "Email" ?></td>
        <td><?= $contato->getDescricao() ?></td>
        <td><?= $contato->getPessoa()->getNome() ?></td>
        <td>
          <a href="/contato/<?= $contato->getId() ?>">Ver</a> |
          <a href="/contato/<?= $contato->getId() ?>/edit">Editar</a> |
          <a href="/contato/<?= $contato->getId() ?>/delete" onclick="return confirm('Deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
