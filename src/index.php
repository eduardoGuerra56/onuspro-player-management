<?php
require 'auth.php';
require 'config.php';

$paginas = [
    'novo'   => 'player.php',
    'lista'  => 'lista.php',
    'salvar' => 'salvar-player.php',
    'editar' => 'editar-player.php',
];

$page = $_REQUEST['page'] ?? 'lista';
$arquivo = $paginas[$page] ?? 'lista.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Players | ONUSPRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">ONUSPRO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="?page=novo">Novo Player</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=lista">Lista de Players</a></li>
            </ul>
            <span class="navbar-text me-3">Olá, <?= e($_SESSION['usuario']['nome']) ?></span>
            <a class="btn btn-outline-light btn-sm" href="logout.php">Sair</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col mt-5">
            <?php include $arquivo; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
