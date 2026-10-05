<?php
require_once __DIR__ . '/../../controller/ClienteController.php';
$controller = new ClienteController();
$dados = $controller->listar();
?>
<h3 class="mt-3">Clientes <a class="btn btn-success float-right" href="?p=add/cliente">Cadastrar cliente</a></h3>
<div class="table-responsive mt-3"><table class="table table-striped"><thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr></thead><tbody>
<?php foreach ($dados as $cliente): ?>
<tr><td><?= (int)$cliente['id'] ?></td><td><?= htmlspecialchars($cliente['nome'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($cliente['email'], ENT_QUOTES, 'UTF-8') ?></td><td><?= htmlspecialchars($cliente['telefone'], ENT_QUOTES, 'UTF-8') ?></td><td><a class="btn btn-primary" href="?p=editar/cliente&id=<?= (int)$cliente['id'] ?>">Editar</a></td></tr>
<?php endforeach; ?>
</tbody></table></div>
