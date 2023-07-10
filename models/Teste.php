<?php

class Teste
{
    private $id;
    private $status;
    private $valor;
    private $descricao;

    /**
     * @return mixed
     */
    public function getId(): int
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
}