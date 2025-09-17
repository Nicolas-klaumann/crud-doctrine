<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Contato</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Editar Contato</h1>

    <form method="POST" action="/contato/<?= $contato->getId() ?>/update" class="form-card">
      <label for="tipo">Tipo:</label>
      <select name="tipo" id="tipo" required>
        <option value="1" <?= $contato->getTipo() ? "selected" : "" ?>>Telefone</option>
        <option value="0" <?= !$contato->getTipo() ? "selected" : "" ?>>Email</option>
      </select>

      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao" id="descricao" value="<?= $contato->getDescricao() ?>" required>

      <label for="idPessoa">Pessoa:</label>
      <select name="idPessoa" id="idPessoa" required>
        <?php foreach ($pessoas as $p): ?>
          <option value="<?= $p->getId() ?>" <?= $contato->getPessoa()->getId() == $p->getId() ? "selected" : "" ?>>
            <?= $p->getNome() ?>
          </option>
        <?php endforeach; ?>
      </select>

      <button type="submit">Salvar</button>
    </form>

    <p><a href="/contato" class="btn-secondary">Voltar</a></p>
  </div>
</body>
</html>
