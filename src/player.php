<h1>Novo Player</h1>

<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label class="form-label" for="nick">Nick</label>
        <input type="text" name="nick" id="nick" class="form-control" maxlength="245" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" maxlength="45" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nascimento">Nascimento</label>
        <input type="date" name="nascimento" id="nascimento" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-control" inputmode="numeric" pattern="\d{11}" maxlength="11" placeholder="Somente números" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
