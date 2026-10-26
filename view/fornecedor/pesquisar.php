<?php
require_once __DIR__ . '/../../controller/FornecedorController.php';
$termo = trim((string)filter_input(INPUT_GET, 'termo'));
$dados = $termo === '' ? [] : (new FornecedorController())->pesquisarPorRazaoSocial($termo);
$h = static fn($valor): string => htmlspecialchars((string)$valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<h3 class="mt-3">Pesquisar fornecedor</h3>
<form class="form-inline mb-3" method="get">
    <input type="hidden" name="p" value="pesquisar/fornecedor">
    <label class="sr-only" for="termo">Razão social do fornecedor</label>
    <input class="form-control mr-2" id="termo" name="termo" type="search" placeholder="Digite a razão social" value="<?= $h($termo) ?>">
    <button class="btn btn-primary" type="submit">Pesquisar</button>
</form>
<?php if ($termo !== ''): ?>
    <?php if ($dados): ?>
        <div class="table-responsive"><table class="table table-striped"><thead><tr><th>ID</th><th>Razão Social</th><th>E-mail</th></tr></thead><tbody>
        <?php foreach ($dados as $fornecedor): ?><tr><td><?= (int)$fornecedor['id'] ?></td><td><?= $h($fornecedor['razao_social']) ?></td><td><?= $h($fornecedor['email']) ?></td></tr><?php endforeach; ?>
        </tbody></table></div>
    <?php else: ?><div class="alert alert-info" role="status">Nenhum fornecedor encontrado.</div><?php endif; ?>
<?php endif; ?>
