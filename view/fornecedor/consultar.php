<?php
require_once __DIR__ . '/../../controller/FornecedorController.php';
$controller = new FornecedorController();
$dados = $controller->listar();
?>
<h3 class="mt-3">Fornecedores <a class="btn btn-success float-right" href="?p=add/fornecedor">Cadastrar fornecedor</a></h3>
<div class="table-responsive mt-3"><table class="table table-striped"><thead><tr><th>ID</th><th>Razão social</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr></thead><tbody>
<?php foreach ($dados as $fornecedor): ?>
<tr><td><?= (int)$fornecedor['id'] ?></td><td><?= htmlspecialchars($fornecedor['razao_social'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($fornecedor['email'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($fornecedor['telefone'], ENT_QUOTES, 'UTF-8') ?></td><td><a class="btn btn-primary" href="?p=editar/fornecedor&id=<?= (int)$fornecedor['id'] ?>">Editar</a></td></tr>
<?php endforeach; ?>
</tbody></table></div>
