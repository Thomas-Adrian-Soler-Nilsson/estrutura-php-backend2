<?php
declare(strict_types=1);

require_once __DIR__ . '/../model/Conn.php';
require_once __DIR__ . '/../model/Fornecedor.php';

class FornecedorDAO
{
    private PDO $conn;

    public function __construct() { $this->conn = new Conn(); }

    public function listar(): array
    {
        return $this->conn->query('SELECT * FROM fornecedor ORDER BY razao_social')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pesquisarPorRazaoSocial(string $razaoSocial): array
    {
        $stmt = $this->conn->prepare("SELECT id, razao_social, email, telefone FROM fornecedor WHERE razao_social LIKE :termo ESCAPE '!' ORDER BY razao_social");
        $stmt->execute([':termo' => '%' . $this->escaparLike(trim($razaoSocial)) . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function escaparLike(string $termo): string
    {
        return str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $termo);
    }

    public function consultarPorId(int $id): ?Fornecedor
    {
        $stmt = $this->conn->prepare('SELECT * FROM fornecedor WHERE id = ?');
        $stmt->execute([$id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$dados) return null;
        return (new Fornecedor())->setId((int)$dados['id'])->setRazaoSocial($dados['razao_social'])->setEmail($dados['email'])->setTelefone($dados['telefone']);
    }

    public function salvar(Fornecedor $fornecedor): bool
    {
        if ($fornecedor->getId() === null) {
            $stmt = $this->conn->prepare('INSERT INTO fornecedor (razao_social, email, telefone) VALUES (?, ?, ?)');
            return $stmt->execute([$fornecedor->getRazaoSocial(), $fornecedor->getEmail(), $fornecedor->getTelefone()]);
        }
        $stmt = $this->conn->prepare('UPDATE fornecedor SET razao_social = ?, email = ?, telefone = ? WHERE id = ?');
        return $stmt->execute([$fornecedor->getRazaoSocial(), $fornecedor->getEmail(), $fornecedor->getTelefone(), $fornecedor->getId()]);
    }
}
