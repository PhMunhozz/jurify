<?php
namespace Api\Controllers;

use Application\UseCases\Cliente\CriarCliente;
use Infrastructure\Persistence\PdoClienteRepository;

class ClienteController {
    private $useCase;

    public function __construct() {
        $this->useCase = new CriarCliente(new PdoClienteRepository());
    }

    public function store(): void {
        $input = json_decode(file_get_contents('php://input'), true);
        $cliente = $this->useCase->execute($input);

        header('Content-Type: application/json');
        echo json_encode(['id' => $cliente->getId(), 'nome' => $cliente->getNome()]);
    }
}