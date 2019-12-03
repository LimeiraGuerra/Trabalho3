<?php

include_once $_SESSION["root"].'php/Utils/Utils.php';
include_once $_SESSION["root"].'php/DAO/UsuarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelUsuario.php';

class ControllerUsuario {
	function setUsuario(){
		$userDAO = new UsuarioDAO();
		$usuario = new ModelUsuario();
		$usuario->setUsuarioFromPOST();
		$resultadoInsercao = $userDAO->setUsuario($usuario);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Cadastrado efetuado com Sucesso!";
			$_SESSION["flash"]["sucesso"]=true;	
			require_once $_SESSION["root"].'php/View/ViewLogin.php';		
		}
		else{
			$_SESSION["flash"]["msg"]="Login já existe!";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$usuario->getNome();
			$_SESSION["flash"]["login"]=$usuario->getLogin();
			require_once $_SESSION["root"].'php/View/ViewCadastro.php';
		}
	}

	function getAllUsuarios(){
		$userDAO = new UsuarioDAO();
		$usuarios=$userDAO->getAllUsuarios();
		include_once $_SESSION["root"].'php/View/ViewUsuarios.php';
	}

	function defModerador(){
		if (isset($_POST["idUser"])) {
			$userDAO = new UsuarioDAO();
			$userDAO->defModerador($_POST["idUser"], $_POST["isMod"]);
		}
	}
}