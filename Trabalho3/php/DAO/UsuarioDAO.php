<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelUsuario.php';
class UsuarioDAO {
	function setUsuario($user){			

		try {
            $sql = "SELECT login FROM users WHERE login = :login";

            //pego uma ref da conexão
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();
            //Utilizando Prepared Statements
            $statement = $conn->prepare($sql);

            $statement->bindValue(":login", $user->getLogin());
            $statement->execute();

            //verifica se o login já existe no banco
            if ($statement->fetch()) {
                return;
            }

			//monto a query
            $sql = "INSERT INTO users (
                nome,
                login,
                senha) 
                VALUES (
                :nome,
                :login,
                :senha)"
        	;

			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":nome", $user->getNome());
            $statement->bindValue(":login", $user->getLogin());
            $statement->bindValue(":senha", $user->getSenha());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}

    function getAllUsuarios(){  
        try {
            //pego uma ref da conexão
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();

            //Faço o select usando prepared statement
            $statement = $conn->prepare("SELECT * FROM users");      
            $statement->execute();

            //linhas recebe todas as tuplas retornadas do banco     
            $linhas = $statement->fetchAll();
            
            //Verifico se houve algum retorno, senão retorno null
            if(count($linhas)==0)
                    return null;

            //Var que irá armazenar um array de obj do tipo funcionário
            $usuarios;      
            
            foreach ($linhas as $value) {
                $usuario = new ModelUsuario();
                $usuario->setUsuarioFromDataBase($value);           
                $usuarios[]=$usuario;
            }   
            return $usuarios; 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }     
    }

    function defModerador($id, $bool){
        try{
            $instance = DatabaseConnection::getInstance();
            $conn = $instance->getConnection();

            $statement = $conn->prepare("UPDATE users SET isModerator = :intBool WHERE idUsers = :idU;"); 
            $statement->bindValue(":idU", $id);  
            $statement->bindValue(":intBool", $bool == 'true' ? 1 : 0);     
            $statement->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }  
    }
}