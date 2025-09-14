<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Novo Contato</title>
</head>
<body>
  <h1>Cadastrar Contato</h1>

  <form method="POST" action="/contatos/store">
    <label>Tipo:</label><br>
    <select name="tipo" required>
      <option value="1">Telefone</option>
      <option value="0">Email</option>
    </select><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" required><br><br>

    <label>Pessoa:</label><br>
    <select name="idPessoa" required>
      <?php foreach ($pessoas as $p): ?>
        <option value="<?= $p->getId() ?>"><?= $p->getNome() ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Salvar</button>
  </form>

  <a href="/contatos">Voltar</a>
</body>
</html>
