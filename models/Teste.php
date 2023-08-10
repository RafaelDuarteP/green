<?php

class Teste
{
    private $id;
    private $status;
    private $valor;
    private $descricao;
    private $nome;
    private $tipoEquipamento;

    private $data;

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id 
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param mixed $status 
     * @return self
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor(): float
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor 
     * @return self
     */
    public function setValor(float $valor): self
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao 
     * @return self
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param mixed $data 
     * @return self
     */
    public function setData(string $data): self
    {
        $this->data = $data;
        return $this;
    }
    public function compareTo($other): int
    {
        if ($this->status == $other->status) {
            return 0;
        }
        return ($this->status > $other->status) ? -1 : 1;
    }

    /**
     * @return mixed
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome 
     * @return self
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoEquipamento(): int
    {
        return $this->tipoEquipamento;
    }

    /**
     * @param mixed $tipoEquipamento 
     * @return self
     */
    public function setTipoEquipamento(int $tipoEquipamento): self
    {
        $this->tipoEquipamento = $tipoEquipamento;
        return $this;
    }
}