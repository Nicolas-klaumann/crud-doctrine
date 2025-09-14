<?php
// src/View/layout.php
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contatos</title>
</head>

<body>
    <h1>Sistema de Contatos</h1>
    <nav>
        <a href="/pessoas">Pessoas</a> |
        <a href="/contatos">Contatos</a>
    </nav>
    <hr>
    <div>
        <?php
        // Decide qual view renderizar conforme rota simples
        $path = $_SERVER['REQUEST_URI'];
        if (strpos($path, '/pessoa/create') === 0) {
            include __DIR__ . '/pessoa/form.php';
        } elseif (strpos($path, '/pessoa/edit') === 0) {
            include __DIR__ . '/pessoa/form.php';
        } elseif (strpos($path, '/pessoa/show') === 0) {
            include __DIR__ . '/pessoa/show.php';
        } else {
            // default pessoa list
            include __DIR__ . '/pessoa/list.php';
        }
        ?>
    </div>
</body>

</html>
