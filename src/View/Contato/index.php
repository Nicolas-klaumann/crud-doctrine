<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Contatos</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Lista de Contatos</h1>

    <p><a href="/pessoa" class="btn-secondary">Voltar para Pessoas</a></p>

    <p><a href="/contato/create" class="btn-primary">+ Novo Contato</a></p>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Descrição</th>
          <th>Pessoa</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($contatos as $contato): ?>
          <tr>
            <td><?= $contato->getId() ?></td>
            <td><?= $contato->getTipo() ? "Telefone" : "Email" ?></td>
            <td><?= $contato->getDescricao() ?></td>
            <td><?= $contato->getPessoa()->getNome() ?></td>
            <td class="actions">
              <a href="/contato/<?= $contato->getId() ?>">Ver</a>
              <a href="/contato/<?= $contato->getId() ?>/edit">Editar</a>
              <a href="/contato/<?= $contato->getId() ?>/delete" onclick="return confirm('Deseja excluir?')">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
