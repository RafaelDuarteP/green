<?php
require_once './models/StatusTeste.php';
class Equipamento
{
    private $id;
    private $nome;
    private $descricao;
    private $tipo;
    private $testes;

    public function __construct()
    {
        $this->testes = array();
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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome 
     * @return self
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao 
     * @return self
     */
    public function setDescricao($descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTestes(): array
    {
        usort(
            $this->testes,
            function ($a, $b) {
                return $a->compareTo($b);
            }
        );
        return $this->testes;
    }

    /**
     * @param mixed $testes 
     * @return self
     */
    public function setTestes(array $testes): self
    {
        $this->testes = $testes;
        return $this;
    }

    public function addTeste(Teste $teste): self
    {
        $this->testes[] = $teste;
        return $this;
    }

    public function removeTeste(Teste $teste): self
    {
        $index = array_search($teste, $this->testes);
        if ($index !== false) {
            unset($this->testes[$index]);
        }
        return $this;
    }

    public function getTotalValorTestes(): float
    {
        $total = 0;
        foreach ($this->testes as $teste) {
            $total += $teste->getValor();
        }
        return $total;
    }

    /**
     * @return mixed
     */
    public function getTipo(): int
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo 
     * @return self
     */
    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function finalizado(): bool
    {
        foreach ($this->testes as $teste) {
            if ($teste->getStatus() === StatusTesteEnum::EM_ANDAMENTO) {
                return false;
            }
        }
        return true;
    }
}