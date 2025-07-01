<?php
namespace Domain\Repositories;

use Domain\Entities\Cliente;

interface ClienteRepositoryInterface {
    public function findById(int $id): ?Cliente;
    public function findAll(): array;
    public function save(Cliente $cliente): void;
    public function delete(int $id): void;
}