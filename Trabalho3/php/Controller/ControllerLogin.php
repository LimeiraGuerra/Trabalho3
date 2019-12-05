<?php

include_once $_SESSION["root"].'php/DAO/LoginDAO.php';
include_once $_SESSION["root"].'php/Utils/Utils.php';

class ControllerLogin {
	function verificaLogin(){
		//verifico se a requisição que chegou nessa pagina é POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//recebo as variaveis por POST
			$login=$_POST["login"];
			$senha=$_POST["senha"];	
			
			$loginDAO = new LoginDAO();	
			//Retorna um usuario ou retorna NULL;
			$user=$loginDAO->verificaLogin($login);
			/*echo "<pre>";
			print_r($user);
			echo "</pre>";*/
			
			//password_verify é um função do PHP que verifica se um string plain text (no caso a senha) é igual a uma hash (que foi retirada do banco)

			//$_SESSION["flash"]["qualquerCoisa"] são variáveis de login que vivem apenas uma requisição, elas são usadas na view e depois destruidas.
			/*print_r($senha);echo"<br>";
			print_r(md5($senha));echo"<br>";
			print_r($user->getSenha());*/
			if ($user!=NULL && Utils::createHash($senha)==$user->getSenha()) {
				$_SESSION["logado"]=true;
				$_SESSION["nomeLogado"]=$user->getNome();
				$_SESSION["idLogado"]=$user->getIdUsuario();
				$_SESSION["isMod"] = $user->isModerador();
				//Coloquei na sessão que o usuário está logado e o seu nome.
				header("Location:dietas");
			}
			else{
				$_SESSION["flash"]["login"]=$login;
				$_SESSION["flash"]["msg"]="Usuário ou senha não conferem";
				$_SESSION["flash"]["sucesso"]=false;
				//Coloquei na sessão "temporária" os avisos e feedbacks necessários, chamo a rota Login	
				header("Location:login");	
			}
		}
	}

	function sairLogin(){
		$_SESSION["logado"]=false;
		header("Location:login");
	}
}