<?php  
include_once $_SESSION["root"].'php/DAO/RefeicoesDAO.php';
include_once $_SESSION["root"].'php/DAO/AlimentosDAO.php';
include_once $_SESSION["root"].'php/Utils/Utils.php';
include_once $_SESSION["root"].'php/Model/ModelRefeicoes.php';

class ControllerRefeicoes{

	function createRefeicao(){
		$resultado = "";
		if (isset($_POST["idDieta"]) && isset($_POST["nome"])) {
			$dietaDAO = new dietasDAO();
			$dietaNome = $dietaDAO->getNameDieta($_POST["idDieta"])[0];
			if ($dietaNome != null) {
				$refDAO = new RefeicoesDAO();
				$ref = new ModelRefeicoes();
				$ref->setRefeicaoFromPOST();
				$resultado = $refDAO->setRefeicao($ref);
			}
		}
		echo $resultado;
	}

	function removeRefeicao(){
		$resultado = "";
		if (isset($_POST["idRefeicao"]) && isset($_POST["idDieta"])) {
			$dietaDAO = new dietasDAO();
			$dietaNome = $dietaDAO->getNameDieta($_POST["idDieta"])[0];
			if ($dietaNome != null) {
				$refDAO = new RefeicoesDAO();
				$resultado = $refDAO->removeRefeicao($_POST["idRefeicao"]);
			}
		}
		echo $resultado;
	}

	function getAllRefeicoes(){
		if (isset($_GET["idDieta"])) {
			$dietaDAO = new dietasDAO();
			$dietaNome = $dietaDAO->getNameDieta($_GET["idDieta"])[0];
				if ($dietaNome != null) {
				$refDAO = new RefeicoesDAO();
				/*$AlimentosDAO = new RequisicaoAlimentos();
				$alimentosList = $AlimentosDAO->getArrayAllAlimentos();*/
				$retornoRefeicoes = $refDAO->getAllRefeicoes($_GET["idDieta"]);
				include_once $_SESSION["root"].'php/View/ViewRefeicoes.php';
			}else{
				header("Location:erro404");
			}
		}else{
			header("Location:erro404");
		}
	}

	function getRefeicao(){
		if (isset($_GET["idRef"])) {
			$refDAO = new RefeicoesDAO();
			$AlimentosDAO = new RequisicaoAlimentos();
			$alimentosList = $AlimentosDAO->getArrayAllAlimentos();
			$refeicao = $refDAO->getRefeicao($_GET["idRef"], $alimentosList);
			if ($refeicao != null) {
				include_once $_SESSION["root"].'php/View/ViewRefeicaoSolo.php';
			}else{
				header("Location:erro404");
			}
		}else{
			header("Location:erro404");
		}
	}

	function addAlimentoRef(){
		if (isset($_POST["idAlimento"]) && isset($_POST["idRef"])) {
			$refDAO = new RefeicoesDAO();
			$resultado = $refDAO->addAlimentoRef();
			echo json_encode($resultado);
		}
	}

	function removeAlimentoRef(){
		if (isset($_POST["idAlimento"]) && isset($_POST["idRefeicao"])) {
			$refDAO = new RefeicoesDAO();
			$resultado = $refDAO->removeAlimentoRef();
			echo $resultado;
		}
	}
}
?>