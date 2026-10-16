<?php
/**
 * Processa as ações de cadastro, edição e exclusão de players.
 * Todas as consultas usam prepared statements para evitar SQL injection.
 */
function redirecionar($mensagem = null)
{
    if ($mensagem) {
        print "<script>alert(" . json_encode($mensagem) . ");</script>";
    }
    print "<script>location.href='?page=lista';</script>";
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar();
    return;
}

$nick       = trim($_POST['nick'] ?? '');
$nome       = trim($_POST['nome'] ?? '');
$email      = trim($_POST['email'] ?? '');
$nascimento = $_POST['nascimento'] ?? '';
$cpf        = preg_replace('/\D/', '', $_POST['cpf'] ?? '');

try {
    switch ($_POST['acao'] ?? '') {
        case 'cadastrar':
            $stmt = $conn->prepare(
                'INSERT INTO players (nick, nome, email, nascimento, cpf) VALUES (?, ?, ?, ?, ?)'
            );
            $stmt->bind_param('sssss', $nick, $nome, $email, $nascimento, $cpf);
            $stmt->execute();
            redirecionar('Player cadastrado com sucesso!');
            break;

        case 'editar':
            $cpfOriginal = preg_replace('/\D/', '', $_POST['cpf_original'] ?? '');
            $stmt = $conn->prepare(
                'UPDATE players SET nick = ?, nome = ?, email = ?, nascimento = ?, cpf = ? WHERE cpf = ?'
            );
            $stmt->bind_param('ssssss', $nick, $nome, $email, $nascimento, $cpf, $cpfOriginal);
            $stmt->execute();
            redirecionar('Player atualizado com sucesso!');
            break;

        case 'excluir':
            $stmt = $conn->prepare('DELETE FROM players WHERE cpf = ?');
            $stmt->bind_param('s', $cpf);
            $stmt->execute();
            redirecionar('Player removido.');
            break;

        default:
            redirecionar();
    }
} catch (mysqli_sql_exception $ex) {
    // Código 1062 = chave duplicada (CPF já cadastrado)
    $mensagem = $ex->getCode() === 1062
        ? 'Já existe um player cadastrado com este CPF.'
        : 'Não foi possível salvar. Contate o administrador.';
    redirecionar($mensagem);
}
