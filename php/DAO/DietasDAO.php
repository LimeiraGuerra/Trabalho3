<?php 
    include_once $_SESSION["root"].'php/Model/ModelDietas.php';
    include_once $_SESSION["root"].'php/Utils/Utils.php';

	class DietasDAO{

		function setDieta($dieta){
			try {
            	$sql = "INSERT INTO dietas (nome, Users_id) VALUES (:nome, :idUser)";

            	$instance = DatabaseConnection::getInstance();
            	$conn = $instance->getConnection();

            	$statement = $conn->prepare($sql);

            	$statement->bindValue(":nome", $dieta->getNome());
                $statement->bindValue(":idUser", $dieta->getidUsuario());

            	$statement->execute();
                return $conn->lastInsertId();

        	} catch (PDOException $e) {
            	echo "Erro ao inserir na base de dados.".$e->getMessage();
        	}
		}

        function removeDieta($idD){
            try {
                $sql = "DELETE FROM dietas WHERE idDietas = :idDieta AND Users_id = :idUser";

                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare($sql);

                $statement->bindValue(":idDieta", $idD);
                $statement->bindValue(":idUser", $_SESSION["idLogado"]);

                $statement->execute();

                return $statement->rowCount();

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function getAllDietas(){  

            try{
                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare("SELECT d.*, 
                    COUNT(r.idRefeicoes) AS totalRefeicoes 
                    FROM dietas d
                    LEFT JOIN refeicoes r
                    ON r.Dietas_id = d.idDietas
                    GROUP BY d.idDietas
                    HAVING d.Users_id = :idUser;");

                $statement->bindValue(":idUser", $_SESSION["idLogado"]);
                $statement->execute();
     
                $linhas = $statement->fetchAll();

                if(count($linhas)==0)
                    return null;

                $dietas;      
                
                foreach ($linhas as $value) {
                    $dieta = new ModelDietas();
                    $refDAO = new refeicoesDAO();
                    $dieta->setDietaFromDataBase($value);
                    $totalKcal = 0;
                    $refDietas = $refDAO->getAllRefeicoes($dieta->getIdDieta());
                    if($refDietas != null){
                        foreach ($refDietas as $key => $val) {
                            $totalKcal += $val->getTotalMacros()[5];
                        }
                    }     
                    $dieta->setTotalKcal($totalKcal);      
                    $dietas[]=$dieta;
                }   
                return $dietas; 

            }  catch (PDOException $e) {
                echo $e->getMessage();
            }    
        }

        function getNameDieta($idDieta){
            try{
                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare("SELECT d.nome FROM dietas d
                                            JOIN users
                                            ON idDietas = :idD
                                            AND idUsers = :idU");
                $statement->bindValue(":idD", $idDieta);
                $statement->bindValue(":idU", $_SESSION["idLogado"]);
                $statement->execute();

                return $statement->fetch();

            }  catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
	}
?>