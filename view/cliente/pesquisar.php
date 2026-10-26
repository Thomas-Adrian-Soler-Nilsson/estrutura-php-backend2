<?php
require_once __DIR__ . '/../../controller/ClienteController.php';
$termo = trim((string)filter_input(INPUT_GET, 'termo'));
$dados = $termo === '' ? [] : (new ClienteController())->pesquisarPorNome($termo);
$h = static fn($valor): string => htmlspecialchars((string)$valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<h3 class="mt-3">Pesquisar cliente</h3>
<form class="form-inline mb-3" method="get">
    <input type="hidden" name="p" value="pesquisar/cliente">
    <label class="sr-only" for="termo">Nome do cliente</label>
    <input class="form-control mr-2" id="termo" name="termo" type="search" placeholder="Digite o nome do cliente" value="<?= $h($termo) ?>">
    <button class="btn btn-primary" type="submit">Pesquisar</button>
</form>
<?php if ($termo !== ''): ?>
    <?php if ($dados): ?>
        <div class="table-responsive"><table class="table table-striped"><thead><tr><th>ID</th><th>Nome</th><th>E-mail</th></tr></thead><tbody>
        <?php foreach ($dados as $cliente): ?><tr><td><?= (int)$cliente['id'] ?></td><td><?= $h($cliente['nome']) ?></td><td><?= $h($cliente['email']) ?></td></tr><?php endforeach; ?>
        </tbody></table></div>
    <?php else: ?><div class="alert alert-info" role="status">Nenhum cliente encontrado.</div><?php endif; ?>
<?php endif; ?>
