<?php
namespace Infrastructure\Persistence;

use Domain\Repositories\ClienteRepositoryInterface;
use Domain\Entities\Cliente;
use Config\Database;
use PDO;

class PdoClienteRepository implements ClienteRepositoryInterface {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function findById(int $id): ?Cliente {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE id = ? AND deleted_at IS NULL");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if (!$data) return null;

        return new Cliente(
            $data['id'], $data['nome'], $data['tipo_pessoa'], $data['documento'],
            $data['email'], $data['telefone'], $data['endereco'],
            $data['cidade'], $data['estado_id']
        );
    }

    public function findAll(): array {
        $stmt = $this->conn->query("SELECT * FROM clientes WHERE deleted_at IS NULL");
        $clientes = [];
        while ($row = $stmt->fetch()) {
            $clientes[] = new Cliente(
                $row['id'], $row['nome'], $row['tipo_pessoa'], $row['documento'],
                $row['email'], $row['telefone'], $row['endereco'],
                $row['cidade'], $row['estado_id']
            );
        }
        return $clientes;
    }

    public function save(Cliente $cliente): void {
        $stmt = $this->conn->prepare("INSERT INTO clientes (nome, tipo_pessoa, documento, email, telefone, endereco, cidade, estado_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $cliente->getNome(),
            $cliente->getTipoPessoa(),
            $cliente->getDocumento(),
            $cliente->getEmail(),
            $cliente->getTelefone(),
            $cliente->getEndereco(),
            $cliente->getCidade(),
            $cliente->getEstadoId()
        ]);

        $id = $this->conn->lastInsertId();
        $cliente->setId((int)$id);
    }

    public function delete(int $id): void {
        $stmt = $this->conn->prepare("UPDATE clientes SET deleted_at = NOW() WHERE id = ?");
        $stmt->execute([$id]);
    }
}