<h1>Edição de Dados</h1>

<?php
$stmt = $conn->prepare('SELECT nick, nome, email, nascimento, cpf FROM players WHERE cpf = ?');
$cpfAtual = $_GET['cpf'] ?? '';
$stmt->bind_param('s', $cpfAtual);
$stmt->execute();
$row = $stmt->get_result()->fetch_object();

if (!$row): ?>
    <p class="alert alert-warning">Player não encontrado.</p>
<?php return; endif; ?>

<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="cpf_original" value="<?= e($row->cpf) ?>">

    <div class="mb-3">
        <label class="form-label" for="nick">Nick</label>
        <input type="text" name="nick" id="nick" value="<?= e($row->nick) ?>" class="form-control" maxlength="245" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?= e($row->nome) ?>" class="form-control" maxlength="45" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= e($row->email) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nascimento">Nascimento</label>
        <input type="date" name="nascimento" id="nascimento" value="<?= e($row->nascimento) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" value="<?= e($row->cpf) ?>" class="form-control" inputmode="numeric" pattern="\d{11}" maxlength="11" required>
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
    <a href="?page=lista" class="btn btn-secondary">Cancelar</a>
</form>
