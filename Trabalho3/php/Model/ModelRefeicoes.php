<?php 
class ModelRefeicoes{

	private $idRefeicao;
	private $nome;
	private $idDieta;
    private $alimentos = array();

	public function setRefeicaoFromPOST(){
        $this->setNome($_POST["nome"])
            ->setIdDieta($_POST["idDieta"]);
    }

    public function setRefeicaoFromDataBase($linha){
        $this->setIdRefeicao($linha["idRefeicoes"])
            ->setNome($linha["nome"])
            ->setIdDieta($linha["Dietas_id"]);
    }

	public function getIdRefeicao(){
        return $this->idRefeicao;
    }

    public function setIdRefeicao($idRefeicao){
        $this->idRefeicao = $idRefeicao;
        return $this;
    }

	public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

	public function getIdDieta(){
        return $this->idDieta;
    }

    public function setIdDieta($idDieta){
        $this->idDieta = $idDieta;
        return $this;
    }

    public function getAllAlimentos(){
        return $this->alimentos;
    }

    public function addAlimentos(){
        $data = func_get_args();
        $this->alimentos[$data[0]] = [$data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]];
        return $this;
    }

    public function getTotalMacros(){
        $ttRef = [0, 0, 0, 0, 0, 0];
        foreach ($this->getAllAlimentos() as $key =>$val) {
            $ttRef[0] += $val[2];
            $ttRef[1] += $val[3];
            $ttRef[2] += $val[4];
            $ttRef[3] += $val[5];
            $ttRef[4] += $val[6];
            $ttRef[5] += $val[7];
        }
        return $ttRef;
    }

}

?>