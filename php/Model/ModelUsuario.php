<?php
class ModelUsuario {

	private $idUsuario;
	private $nome; 
	private $login;
	private $senha;
    private $moderador; 

    /**
     * Popula um obj funcionario com os dados vindos da tabela funcionario. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setUsuarioFromDataBase($linha){
        $this->setIdUsuario($linha["idUsers"])
               ->setNome($linha["nome"])
               ->setLogin($linha['login'])
               ->setSenhaSemHash($linha['senha'])
               ->setModerador($linha['isModerator'] == 0 ? false : true);
    }
    public function setUsuarioFromPOST(){
        $this->setNome($_POST["nome"])
               ->setLogin($_POST['login'])
               ->setSenhaComHash($_POST['senha']);
    }

    /**
     * Gets the value of idUsuario.
     *
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Sets the value of idUsuario.
     *
     * @param mixed $idUsuario the id funcionario
     *
     * @return self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenhaComHash($senha)
    {
        $this->senha = Utils::createHash($senha);

        return $this;
    }
    public function setSenhaSemHash($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function setModerador($boolean){
        $this->moderador = $boolean;
        return $this;
    }

    public function isModerador(){
        return $this->moderador;
    }
}
