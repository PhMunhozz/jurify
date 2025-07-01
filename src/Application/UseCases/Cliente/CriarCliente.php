<?php
namespace Application\UseCases\Cliente;

use Domain\Repositories\ClienteRepositoryInterface;
use Domain\Entities\Cliente;

class CriarCliente {
    private $repo;

    public function __construct(ClienteRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function execute(array $dados): Cliente {
        $cliente = new Cliente(
            null,
            $dados['nome'],
            $dados['tipo_pessoa'],
            $dados['documento'],
            $dados['email'] ?? null,
            $dados['telefone'] ?? null,
            $dados['endereco'] ?? null,
            $dados['cidade'] ?? null,
            $dados['estado_id'] ?? null
        );

        $this->repo->save($cliente);
        return $cliente;
    }
}