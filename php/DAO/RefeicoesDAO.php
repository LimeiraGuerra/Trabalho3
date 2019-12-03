<?php 
    include_once $_SESSION["root"].'php/Model/ModelRefeicoes.php';
    include_once $_SESSION["root"].'php/Utils/Utils.php';

	class RefeicoesDAO{

		function setRefeicao($refeicao){
			try {
            	$sql = "INSERT INTO refeicoes (nome, Dietas_id) VALUES (:nome, :idDieta)";

            	$instance = DatabaseConnection::getInstance();
            	$conn = $instance->getConnection();

            	$statement = $conn->prepare($sql);

            	$statement->bindValue(":nome", $refeicao->getNome());
                $statement->bindValue(":idDieta", $refeicao->getIdDieta());

            	$statement->execute();
                return $conn->lastInsertId();

        	} catch (PDOException $e) {
            	echo "Erro ao inserir na base de dados.".$e->getMessage();
        	}
		}

        function removeRefeicao($idR){
            try {
                $sql = "DELETE FROM refeicoes WHERE idRefeicoes = :idR";

                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare($sql);

                $statement->bindValue(":idR", $idR);

                $statement->execute();

                return $statement->rowCount();

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function getAllRefeicoes($idDieta){  

            try{
                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare("SELECT * FROM refeicoes
                    WHERE Dietas_id = :idDieta;");

                $statement->bindValue(":idDieta", $idDieta);
                $statement->execute();
     
                $linhas = $statement->fetchAll();

                if(count($linhas)==0)
                    return null;

                $dietas;      
                

                $AlimentosDAO = new RequisicaoAlimentos();
                $alimentosList = $AlimentosDAO->getArrayAllAlimentos();
                //Utils::debug($linhas);

                foreach ($linhas as $value) {
                    $ref = new ModelRefeicoes();
                    $ref->setRefeicaoFromDataBase($value);
                    $alimentos = $conn->query("SELECT Alimentos_id, gramas FROM refeicoes_alimentos WHERE Refeicoes_id = ".$value["idRefeicoes"]);
                    foreach ($alimentos->fetchAll() as $value) {
                        $auxAli = $alimentosList[$value["Alimentos_id"]];
                        $auxQtd = $value["gramas"]/100;
                        $ref->addAlimentos($value["Alimentos_id"], $auxAli["nome"], $value["gramas"], intval($auxAli["proteinas"])*$auxQtd, intval($auxAli["carboidratos"])*$auxQtd, intval($auxAli["lipidios"])*$auxQtd, intval($auxAli["fibra"])*$auxQtd, intval($auxAli["umidade"])*$auxQtd, intval($auxAli["kcal_calculada"])*$auxQtd);
                    }           
                    $refs[]=$ref;
                }   
                return $refs; 

            }  catch (PDOException $e) {
                echo $e->getMessage();
            }    
        }

        function getRefeicao($idRef, $alimentosList){
            try{
                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare("SELECT r.* FROM refeicoes r
                                            JOIN dietas d
                                            ON d.idDietas = r.Dietas_id
                                            AND r.idRefeicoes = :idRef
                                            AND d.Users_id = :idU");
                $statement->bindValue(":idRef", $idRef);
                $statement->bindValue(":idU", $_SESSION["idLogado"]);
                $statement->execute();
                $resultado = $statement->fetch();

                if ($resultado == null) {
                    return null;
                }

                $ref = new ModelRefeicoes();
                $ref->setRefeicaoFromDataBase($resultado);

                $statement = $conn->prepare("SELECT Alimentos_id, gramas FROM refeicoes_alimentos WHERE Refeicoes_id = :idRef");
                $statement->bindValue(":idRef", $idRef);
                $statement->execute();

                foreach ($statement->fetchAll() as $value) {
                    $auxAli = $alimentosList[$value["Alimentos_id"]];
                    $auxQtd = $value["gramas"]/100;
                    $ref->addAlimentos($value["Alimentos_id"], $auxAli["nome"], $value["gramas"], intval($auxAli["proteinas"])*$auxQtd, intval($auxAli["carboidratos"])*$auxQtd, intval($auxAli["lipidios"])*$auxQtd, intval($auxAli["fibra"])*$auxQtd, intval($auxAli["umidade"])*$auxQtd, intval($auxAli["kcal_calculada"])*$auxQtd);
                }
                return $ref;

            }  catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function addAlimentoRef(){
            try {
                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare("INSERT INTO refeicoes_alimentos (Refeicoes_id, Alimentos_id, gramas) VALUES (:idRef, :idAlim, :gramas);");

                $statement->bindValue(":idRef", $_POST['idRef']);
                $statement->bindValue(":idAlim", $_POST['idAlimento']);
                $statement->bindValue(":gramas", $_POST['qdtGrama']);

                $statement->execute();

                return $_POST;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        function removeAlimentoRef(){
            try {
                $sql = "DELETE FROM refeicoes_alimentos WHERE Refeicoes_id = :idRef AND Alimentos_id = :idAlim";

                $instance = DatabaseConnection::getInstance();
                $conn = $instance->getConnection();

                $statement = $conn->prepare($sql);

                $statement->bindValue(":idRef", $_POST["idRefeicao"]);
                $statement->bindValue(":idAlim", $_POST["idAlimento"]);

                $statement->execute();

                return $statement->rowCount();

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
	}
?>