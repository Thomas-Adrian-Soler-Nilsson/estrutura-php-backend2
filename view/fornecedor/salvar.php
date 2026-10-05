<?php
require_once __DIR__ . '/../../controller/FornecedorController.php';
$controller = new FornecedorController();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$fornecedor = $id ? $controller->consultarPorId($id) : null;
$erro = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erro = !$controller->salvar();
    if (!$erro) { header('Location: ?p=fornecedores'); exit; }
}
if ($id && !$fornecedor) { echo '<div class="alert alert-warning">Fornecedor não encontrado.</div>'; return; }
$razaoSocial = $_POST['razao_social'] ?? $fornecedor?->getRazaoSocial() ?? '';
$email = $_POST['email'] ?? $fornecedor?->getEmail() ?? '';
$telefone = $_POST['telefone'] ?? $fornecedor?->getTelefone() ?? '';
?>
<h3 class="mt-3"><?= $fornecedor ? 'Editar fornecedor' : 'Cadastrar fornecedor' ?></h3>
<?php if ($erro): ?><div class="alert alert-danger">Não foi possível salvar o fornecedor.</div><?php endif; ?>
<form method="post" class="card card-body mt-3">
<?php if ($fornecedor): ?><input type="hidden" name="id" value="<?= $fornecedor->getId() ?>"><?php endif; ?>
<div class="form-group"><label for="razao_social">Razão social</label><input required class="form-control" id="razao_social" name="razao_social" value="<?= htmlspecialchars($razaoSocial, ENT_QUOTES, 'UTF-8') ?>"></div>
<div class="form-group"><label for="email">E-mail</label><input required type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"></div>
<div class="form-group"><label for="telefone">Telefone</label><input required class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8') ?>"></div>
<div><button class="btn btn-primary" type="submit">Salvar</button> <a class="btn btn-secondary" href="?p=fornecedores">Cancelar</a></div>
</form>
