<?php

declare(strict_types=1);

require_once '../model/Conn.php';
require_once '../model/Categoria.php';

class CategoriaDAO
{
    private PDO $conn;
    private string $tabela = "categoria";

    public function __construct()
    {
        $this->conn = new Conn();
    }

    private function texto(string $texto): string
    {
        return mb_strtoupper(trim($texto));
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id);
        return $executar->execute();
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM {$this->tabela} ORDER BY nome";
        $executar = $this->conn->query($sql);
        return $executar->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorID(int $id): ?Categoria
    {
        $sql = "SELECT * FROM {$this->tabela} WHERE id = ?";
        $executar = $this->conn->prepare($sql);
        $executar->bindValue(1, $id);
        $executar->execute();
        $dados = $executar->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $categoria = new Categoria();
        $categoria->setId($dados["id"]);
        $categoria->setNome($dados["nome"]);
        $categoria->setInformacoes($dados["informacoes"]);

        return $categoria;

    }

    public function salvar(Categoria $categoria): bool
    {
        if ($categoria->getId() == null) {

            $sql = "INSERT INTO categoria
                    (nome,informacoes)
                    VALUES
                    (?,?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($categoria->getNome()));
            $stmt->bindValue(2, $this->texto($categoria->getInformacoes()));
        } else {

            $sql = "UPDATE categoria
                       SET nome=?,
                           informacoes=?
                     WHERE id=?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $this->texto($categoria->getNome()));
            $stmt->bindValue(2, $this->texto($categoria->getInformacoes()));
            $stmt->bindValue(3, $categoria->getId());
        }

        return $stmt->execute();
    }
}