<?php

declare(strict_types=1);

require_once "../model/Fornecedor.php";
require_once "../dao/FornecedorDAO.php";

class FornecedorController
{
    private Fornecedor $fornecedor;
    private FornecedorDAO $dao;

    public function __construct()
    {
        $this->fornecedor = new Fornecedor();
        $this->dao = new FornecedorDAO();
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function consultarPorID(int $id): ?Fornecedor
    {
        return $this->dao->consultarPorID($id);
    }

    public function salvar(): bool
    {
        $id           = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $razao_social = trim((string) filter_input(INPUT_POST, "razao_social"));
        $email        = trim((string) filter_input(INPUT_POST, "email"));
        $telefone     = trim((string) filter_input(INPUT_POST, "telefone"));

        // Validacao: campos obrigatorios
        if ($razao_social === "" || $email === "" || $telefone === "") {
            return false;
        }

        // Validacao: formato de e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->fornecedor->setId($id ?: null);
        $this->fornecedor->setRazaoSocial($razao_social);
        $this->fornecedor->setEmail($email);
        $this->fornecedor->setTelefone($telefone);

        return $this->dao->salvar($this->fornecedor);
    }
}