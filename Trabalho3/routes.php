<?php
/*
Esse script funciona como um front controller, todas as requisições passam primeiro por aqui, também podemos enxergar como um gateway padrão. Isso só é possível graças ao htaccess que faz com que o todas as requisições feitas sejam redirecionadas para cá.
Da forma como esse arquivo de rotas funciona, nós não fazemos “links” para arquivos, nós associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path é um array onde cada posição é um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);
//Action é a posição do array
$action = $path[sizeOf($path) - 1];
//Caso a ação tenha param GET esse param é ignorado, isso é particularmente útil para trabalhar com AJAX, já que o conteúdo do get será útil apenas para o controller e não para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posição do array, que é a ação que o usuário/sistema quer realizar, é essa ação(string) que é mapeada(roteada) a um método de um controller<br>";
print_r($action);
echo "</pre>";*/

//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerUsuario.php';
include_once $_SESSION["root"].'php/Controller/ControllerAlimentos.php';
include_once $_SESSION["root"].'php/Controller/ControllerDietas.php';
include_once $_SESSION["root"].'php/Controller/ControllerRefeicoes.php';

//Sequencia de condicionais que verificam se a ação informada está roteada
//Usuário logado
if(isset($_SESSION["logado"]) && $_SESSION["logado"]){
	if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login' || $action == 'cadastro') {
		header("Location:dietas");
	}

	else if ($action == 'dietas') {
		$cDi = new ControllerDietas();
		$cDi->getAllDietas();
	}

	else if ($action == 'addDieta') {
		$cDi = new ControllerDietas();
		$cDi->createDieta();
	}

	else if ($action == 'removeDieta') {
		$cDi = new ControllerDietas();
		$cDi->removeDieta();
	}

	else if ($action == 'refeicoes') {
		$cRef = new ControllerRefeicoes();
		$cRef->getAllRefeicoes();
	}

	else if ($action == 'addRefeicao') {
		$cRef = new ControllerRefeicoes();
		$cRef->createRefeicao();
	}

	else if ($action == 'removeRefeicao') {
		$cRef = new ControllerRefeicoes();
		$cRef->removeRefeicao();
	}

	else if ($action == 'refeicaoSolo') {
		$cRef = new ControllerRefeicoes();
		$cRef->getRefeicao();
	}

	else if($action == 'addAlimRef'){
		$cRef = new ControllerRefeicoes();
		$cRef->addAlimentoRef();
	}

	else if($action == 'removeAlimRef'){
		$cRef = new ControllerRefeicoes();
		$cRef->removeAlimentoRef();
	}

	else if ($action == 'sair') {
		$cLogin = new ControllerLogin();
		$cLogin->sairLogin();
	}
	
	else if(isset($_SESSION["isMod"]) && $_SESSION["isMod"]){
		if ($action == 'editarAlimentos') {
			$cAlim = new ControllerAlimentos();
			$cAlim->showAlimentos();
		}

		else if ($action == 'novoAlimento') {
			require_once $_SESSION["root"].'php/View/ViewNovoAlimento.php';
		}

		else if ($action == 'modAlimentos') {
			$cAlim = new ControllerAlimentos();
			$cAlim->modAlimentos();
		}

		else if($action == 'listaUsuarios'){
			$cUser = new ControllerUsuario();
			$cUser->getAllUsuarios();
		}

		else if($action == 'defModerador'){
			$cUser = new ControllerUsuario();
			$cUser->defModerador();
		}

		else {
			require_once $_SESSION["root"].'php/View/View404.php';
		}
	}

	else {
		require_once $_SESSION["root"].'php/View/View404.php';
	}
}

//Usuário deslogado
else if ($action == '' || $action == 'index' || $action == 'index.php') {
	header("Location:login");
}

else if($action == 'login'){
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}

else if ($action == 'cadastro') {
	require_once $_SESSION["root"].'php/View/ViewCadastro.php';
}

else if ($action == 'postCadastro') {
	$cUser = new ControllerUsuario();
	$cUser->setUsuario();
}

else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}

else if ($action == 'refeicoesApi') { //Rota de API
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if (isset($_GET["idRef"])) {
			$cRef = new ControllerRefeicoes();
			$cRef->getRefeicaoApi();
		}
		else{
			$cRef = new ControllerRefeicoes();
			$cRef->getAllRefeicoesApi();
		}
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$dadosRecebidos = json_decode(file_get_contents("php://input"), true);
		$cRef = new ControllerRefeicoes();
		$cRef->createRefeicaoApi($dadosRecebidos["nome"]);
	}

	else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
		$dadosRecebidos = json_decode(file_get_contents("php://input"), true);
		$cRef = new ControllerRefeicoes();
		$cRef->removeRefeicaoApi($dadosRecebidos["idRef"]);
	}

	else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
		$dadosRecebidos = json_decode(file_get_contents("php://input"), true);
		$cRef = new ControllerRefeicoes();
		if (isset($dadosRecebidos['gramas'])) {
		$cRef->addAlimentoRefApi($dadosRecebidos['idRef'], $dadosRecebidos['idAli'], $dadosRecebidos['gramas']);
		}
		else{
			$cRef->removeAlimentoRefApi($dadosRecebidos['idRef'], $dadosRecebidos['idAli']);
		}
	}
}

else {
	require_once $_SESSION["root"].'php/View/View404.php';
	//isso trata todo erro 404, podemos criar uma view mais elegante para exibir o aviso ao usuário.
}

?>