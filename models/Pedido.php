<?php

class Pedido
{
    private $id;
    private $data;
    private $numero;
    private $total;
    private $status;
    private $equipamentos;
    private $idCliente;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id 
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero 
     * @return self
     */
    public function setNumero($numero): self
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total 
     * @return self
     */
    public function setTotal($total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status 
     * @return self
     */
    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEquipamentos(): array
    {
        return $this->equipamentos;
    }

    /**
     * @param mixed $equipamentos 
     * @return self
     */
    public function setEquipamentos(array $equipamentos): self
    {
        $this->equipamentos = $equipamentos;
        return $this;
    }

    public function addEquipamento(Equipamento $equipamento): self
    {
        $this->equipamentos[] = $equipamento;
        return $this;
    }

    public function removeEquipamento(Equipamento $equipamento): self
    {
        $index = array_search($equipamento, $this->equipamentos);
        if ($index !== false) {
            unset($this->equipamentos[$index]);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param mixed $idCliente 
     * @return self
     */
    public function setIdCliente($idCliente): self
    {
        $this->idCliente = $idCliente;
        return $this;
    }
}