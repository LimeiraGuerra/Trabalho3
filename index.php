<?php
//Inicia a sessão
session_start();

//Add o caminho sistema a uma váriavel de sessão; descomentar o printr para entender melhor
if (!isset($_SESSION["root"])) {
	$_SESSION["root"] = 'C:/xampp/htdocs/php/Trabalho3/';
}
//print_r($_SESSION["root"] );

//Chamo o arquivo responsável por gerenciar as rotas do sistema
include $_SESSION["root"].'routes.php';
?>