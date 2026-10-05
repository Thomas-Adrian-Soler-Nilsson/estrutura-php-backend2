<?php
require_once __DIR__ . '/../../controller/ClienteController.php';
$controller = new ClienteController();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$cliente = $id ? $controller->consultarPorId($id) : null;
$erro = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erro = !$controller->salvar();
    if (!$erro) { header('Location: ?p=clientes'); exit; }
}
if ($id && !$cliente) { echo '<div class="alert alert-warning">Cliente não encontrado.</div>'; return; }
$nome = $_POST['nome'] ?? $cliente?->getNome() ?? '';
$email = $_POST['email'] ?? $cliente?->getEmail() ?? '';
$telefone = $_POST['telefone'] ?? $cliente?->getTelefone() ?? '';
?>
<h3 class="mt-3"><?= $cliente ? 'Editar cliente' : 'Cadastrar cliente' ?></h3>
<?php if ($erro): ?><div class="alert alert-danger">Não foi possível salvar o cliente.</div><?php endif; ?>
<form method="post" class="card card-body mt-3">
<?php if ($cliente): ?><input type="hidden" name="id" value="<?= $cliente->getId() ?>"><?php endif; ?>
<div class="form-group"><label for="nome">Nome</label><input required class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>"></div>
<div class="form-group"><label for="email">E-mail</label><input required type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"></div>
<div class="form-group"><label for="telefone">Telefone</label><input required class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8') ?>"></div>
<div><button class="btn btn-primary" type="submit">Salvar</button> <a class="btn btn-secondary" href="?p=clientes">Cancelar</a></div>
</form>
