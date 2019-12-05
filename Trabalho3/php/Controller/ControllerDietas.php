<?php  
include_once $_SESSION["root"].'php/DAO/DietasDAO.php';
include_once $_SESSION["root"].'php/Utils/Utils.php';
include_once $_SESSION["root"].'php/Model/ModelDietas.php';

class ControllerDietas{

	function createDieta(){
		if (isset($_POST["nome"])) {
			$dietasDAO = new DietasDAO();
			$dieta = new ModelDietas();
			$dieta->setDietaFromPOST();
			$dieta->setIdUsuario($_SESSION["idLogado"]);
			$resultado = $dietasDAO->setDieta($dieta);
			echo $resultado;
		}
	}

	function removeDieta(){
		if (isset($_POST["idDieta"])) {
			$dietasDAO = new DietasDAO();
			$resultado = $dietasDAO->removeDieta($_POST["idDieta"]);
			echo $resultado;
		}
	}

	function getAllDietas(){
		$dietasDAO = new DietasDAO();
		$retornoDietas = $dietasDAO->getAllDietas();
		//retornar também a qtd de refeições e o total de kcal
		include_once $_SESSION["root"].'php/View/ViewDietas.php';
	}
}
?>