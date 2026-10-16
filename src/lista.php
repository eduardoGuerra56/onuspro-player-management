<h1>Lista de Players</h1>

<?php
$res = $conn->query('SELECT nick, nome, email, nascimento, cpf FROM players ORDER BY nick');

if ($res->num_rows > 0): ?>
    <p>Encontrou <b><?= $res->num_rows ?></b> resultado(s).</p>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nick</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nascimento</th>
                    <th>CPF</th>
                    <th>Interação</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $res->fetch_object()): ?>
                <tr>
                    <td><?= e($row->nick) ?></td>
                    <td><?= e($row->nome) ?></td>
                    <td><?= e($row->email) ?></td>
                    <td><?= e(date('d/m/Y', strtotime($row->nascimento))) ?></td>
                    <td><?= e($row->cpf) ?></td>
                    <td class="text-nowrap">
                        <a href="?page=editar&amp;cpf=<?= urlencode($row->cpf) ?>" class="btn btn-success btn-sm">Editar</a>
                        <form action="?page=salvar" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem certeza que deseja demitir este player?');">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="cpf" value="<?= e($row->cpf) ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Demitir</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="alert alert-warning">Não encontrou resultados.</p>
<?php endif; ?>
