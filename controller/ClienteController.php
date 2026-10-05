<?php

declare(strict_types=1);

require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

class ClienteController
{
    private Cliente $cliente;
    private ClienteDAO $dao;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->dao = new ClienteDAO();
    }

    public function listar(): array
    {
        return $this->dao->listar();
    }

    public function consultarPorID(int $id): ?Cliente
    {
        return $this->dao->consultarPorID($id);
    }

    public function salvar(): bool
    {
        $id       = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $nome     = trim((string) filter_input(INPUT_POST, "nome"));
        $email    = trim((string) filter_input(INPUT_POST, "email"));
        $telefone = trim((string) filter_input(INPUT_POST, "telefone"));

        // Validacao: campos obrigatorios
        if ($nome === "" || $email === "" || $telefone === "") {
            return false;
        }

        // Validacao: formato de e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->cliente->setId($id ?: null);
        $this->cliente->setNome($nome);
        $this->cliente->setEmail($email);
        $this->cliente->setTelefone($telefone);

        return $this->dao->salvar($this->cliente);
    }
}