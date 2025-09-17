<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Nova Pessoa</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
  <h1>Cadastrar Pessoa</h1>

  <form method="POST" action="/pessoa/store">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>CPF:</label>
    <input type="text" name="cpf" required>

    <button type="submit">Salvar</button>
  </form>

  <p><a href="/pessoa">Voltar</a></p>
</div>
</body>
</html>
