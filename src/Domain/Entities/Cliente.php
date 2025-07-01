<?php
namespace Domain\Entities;

class Cliente {
    private $id;
    private $nome;
    private $tipoPessoa;
    private $documento;
    private $email;
    private $telefone;
    private $endereco;
    private $cidade;
    private $estadoId;

    public function __construct($id, $nome, $tipoPessoa, $documento, $email = null, $telefone = null, $endereco = null, $cidade = null, $estadoId = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipoPessoa = $tipoPessoa;
        $this->documento = $documento;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->estadoId = $estadoId;
    }

    public function getId() { return $this->id; }
    public function setId(int $id): void {$this->id = $id;}

    public function getNome() { return $this->nome; }
    public function getTipoPessoa() { return $this->tipoPessoa; }
    public function getDocumento() { return $this->documento; }
    public function getEmail() { return $this->email; }
    public function getTelefone() { return $this->telefone; }
    public function getEndereco() { return $this->endereco; }
    public function getCidade() { return $this->cidade; }
    public function getEstadoId() { return $this->estadoId; }
}