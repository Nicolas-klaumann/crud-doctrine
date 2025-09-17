<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Pessoa</title>
</head>
<body>
  <h1>Editar Pessoa</h1>

  <form method="POST" action="/pessoa/<?= $pessoa->getId() ?>/update">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= $pessoa->getNome() ?>" required><br><br>

    <label>CPF:</label><br>
    <input type="text" name="cpf" value="<?= $pessoa->getCpf() ?>" required><br><br>

    <button type="submit">Salvar</button>
  </form>

  <a href="/pessoa">Voltar</a>
</body>
</html>
