<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Contato</title>
</head>
<body>
  <h1>Editar Contato</h1>

  <form method="POST" action="/contato/<?= $contato->getId() ?>/update">
    <label>Tipo:</label><br>
    <select name="tipo" required>
      <option value="1" <?= $contato->getTipo() ? "selected" : "" ?>>Telefone</option>
      <option value="0" <?= !$contato->getTipo() ? "selected" : "" ?>>Email</option>
    </select><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" value="<?= $contato->getDescricao() ?>" required><br><br>

    <label>Pessoa:</label><br>
    <select name="idPessoa" required>
      <?php foreach ($pessoas as $p): ?>
        <option value="<?= $p->getId() ?>" <?= $contato->getPessoa()->getId() == $p->getId() ? "selected" : "" ?>>
          <?= $p->getNome() ?>
        </option>
      <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Salvar</button>
  </form>

  <a href="/contato">Voltar</a>
</body>
</html>
