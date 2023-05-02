<?php

class Cliente
{
    private $id;
    private $email;
    private $senha;
    private $razao_social;
    private $cnpj;
    private $nome;
    private $token;
    private $verificado;

    /**
     * Retorna o email do cliente
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Define o email do cliente
     *
     * @param string $email 
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Retorna a senha do cliente
     *
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * Define a senha do cliente (criptografada com password_hash)
     *
     * @param string $senha 
     * @return self
     */
    public function setSenha(string $senha): self
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        return $this;
    }

    public function setSenhaHashed(string $senha): self
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * Retorna a razão social do cliente
     *
     * @return string
     */
    public function getRazaoSocial(): string
    {
        return $this->razao_social;
    }

    /**
     * Define a razão social do cliente
     *
     * @param string $razao_social 
     * @return self
     */
    public function setRazaoSocial(string $razao_social): self
    {
        $this->razao_social = $razao_social;
        return $this;
    }

    /**
     * Retorna o CNPJ do cliente
     *
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * Define o CNPJ do cliente
     *
     * @param string $cnpj 
     * @return self
     */
    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * Retorna o nome do cliente
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define o nome do cliente
     *
     * @param string $nome 
     * @return self
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Retorna o ID do cliente
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o ID do cliente
     *
     * @param int $id 
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
	public function getToken():string {
		return $this->token;
	}
	
	/**
	 * @param mixed $token 
	 * @return self
	 */
	public function setToken(string $token): self {
		$this->token = $token;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getVerificado():bool {
		return $this->verificado;
	}
	
	/**
	 * @param mixed $verificado 
	 * @return self
	 */
	public function setVerificado(bool $verificado): self {
		$this->verificado = $verificado;
		return $this;
	}
}