<?php
session_start();
require 'config.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user  = trim($_POST['user'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($user === '') {
        $erro = 'Preencha seu usuário.';
    } elseif ($senha === '') {
        $erro = 'Preencha sua senha.';
    } else {
        $stmt = $conn->prepare('SELECT id, nome, senha FROM usuarios WHERE user = ?');
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $usuario = $stmt->get_result()->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = ['id' => $usuario['id'], 'nome' => $usuario['nome']];
            header('Location: index.php?page=lista');
            exit;
        }

        $erro = 'Falha ao logar! Usuário ou senha incorretos.';
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ONUSPRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">ONUSPRO</span>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 mt-5">
            <div class="card rounded-4 shadow">
                <div class="card-body p-5">
                    <h1 class="fw-bold mb-4 fs-2 text-center">Seja bem-vindo ao ONUSPRO!</h1>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" name="user" id="user" placeholder="Usuário" required>
                            <label for="user">Usuário</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" name="senha" id="senha" placeholder="Senha" required>
                            <label for="senha">Senha</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Entrar</button>
                        <small class="text-muted">Caso não tenha login, entre em contato com nossa equipe!</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
