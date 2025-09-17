<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Pessoa</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
  <h1>Editar Pessoa</h1>

  <form method="POST" action="/pessoa/<?= $pessoa->getId() ?>/update">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $pessoa->getNome() ?>" required>

    <label>CPF:</label>
    <input type="text" name="cpf" value="<?= $pessoa->getCpf() ?>" required>

    <button type="submit">Salvar</button>
  </form>

  <p><a href="/pessoa">Voltar</a></p>
</div>
</body>
</html>
