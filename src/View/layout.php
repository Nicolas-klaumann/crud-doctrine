<?php
// src/View/layout.php
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Sistema de Contatos</title>
</head>

<body>
    <h1>Sistema de Contatos</h1>
    <nav>
        <a href="/pessoa">Pessoas</a> |
        <a href="/contato">Contatos</a>
    </nav>
    <hr>

    <div>
        <?php
        $path = $_SERVER['REQUEST_URI'];

        // Pessoas
        if (strpos($path, '/pessoa/create') === 0) {
            include __DIR__ . '/pessoa/form.php';
        } elseif (strpos($path, '/pessoa/') === 0 && strpos($path, '/edit') !== false) {
            include __DIR__ . '/pessoa/form.php';
        } elseif (strpos($path, '/pessoa/') === 0 && strpos($path, '/show') !== false) {
            include __DIR__ . '/pessoa/show.php';
        } elseif (strpos($path, '/pessoa') === 0) {
            include __DIR__ . '/pessoa/list.php';

        // Contatos
        } elseif (strpos($path, '/contato/create') === 0) {
            include __DIR__ . '/contato/form.php';
        } elseif (strpos($path, '/contato/') === 0 && strpos($path, '/edit') !== false) {
            include __DIR__ . '/contato/form.php';
        } elseif (strpos($path, '/contato/') === 0 && strpos($path, '/show') !== false) {
            include __DIR__ . '/contato/show.php';
        } elseif (strpos($path, '/contato') === 0) {
            include __DIR__ . '/contato/list.php';

        // Default (pessoas)
        } else {
            include __DIR__ . '/pessoa/list.php';
        }
        ?>
    </div>
</body>

</html>
