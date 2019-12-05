<?php  
class ModelDietas{

	private $idDieta;
	private $nome;
	private $idUsuario;
    private $totalKcal;
    private $totalRefeicoes;

	public function setDietaFromPOST(){
        $this->setNome($_POST["nome"]);
    }

    public function setDietaFromDataBase($linha){
        $this->setIdDieta($linha["idDietas"])
            ->setNome($linha["nome"])
            ->setTotalRefeicoes($linha["totalRefeicoes"])
            ->setIdUsuario($linha["Users_id"]);
    }

	public function getIdDieta(){
        return $this->idDieta;
    }

    public function setIdDieta($idDieta){
        $this->idDieta = $idDieta;
        return $this;
    }

	public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

	public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
        return $this;
    }

    public function getTotalKcal(){
        return $this->totalKcal;
    }

    public function setTotalKcal($totalKcal){
        $this->totalKcal = $totalKcal;
        return $this;
    }

    public function getTotalRefeicoes(){
        return $this->totalRefeicoes;
    }

    public function setTotalRefeicoes($totalRefeicoes){
        $this->totalRefeicoes = $totalRefeicoes;
        return $this;
    }
}

?>