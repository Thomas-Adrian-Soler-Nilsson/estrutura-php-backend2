<?php
declare(strict_types=1);

require_once __DIR__ . '/../model/Conn.php';
require_once __DIR__ . '/../model/Cliente.php';

class ClienteDAO
{
    private PDO $conn;

    public function __construct() { $this->conn = new Conn(); }

    public function listar(): array
    {
        return $this->conn->query('SELECT * FROM cliente ORDER BY nome')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorId(int $id): ?Cliente
    {
        $stmt = $this->conn->prepare('SELECT * FROM cliente WHERE id = ?');
        $stmt->execute([$id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$dados) return null;
        return (new Cliente())->setId((int)$dados['id'])->setNome($dados['nome'])->setEmail($dados['email'])->setTelefone($dados['telefone']);
    }

    public function salvar(Cliente $cliente): bool
    {
        if ($cliente->getId() === null) {
            $stmt = $this->conn->prepare('INSERT INTO cliente (nome, email, telefone) VALUES (?, ?, ?)');
            return $stmt->execute([$cliente->getNome(), $cliente->getEmail(), $cliente->getTelefone()]);
        }
        $stmt = $this->conn->prepare('UPDATE cliente SET nome = ?, email = ?, telefone = ? WHERE id = ?');
        return $stmt->execute([$cliente->getNome(), $cliente->getEmail(), $cliente->getTelefone(), $cliente->getId()]);
    }
}
