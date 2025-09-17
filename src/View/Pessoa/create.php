<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Nova Pessoa</title>
</head>
<body>
  <h1>Cadastrar Pessoa</h1>

  <form method="POST" action="/pessoa/store">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>CPF:</label><br>
    <input type="text" name="cpf" required><br><br>

    <button type="submit">Salvar</button>
  </form>

  <a href="/pessoa">Voltar</a>
</body>
</html>
