<?php
    //Incluo classe de que sabe conversar com a API
    include_once $_SESSION["root"].'php/DAO/AlimentosDAO.php';

    class ControllerAlimentos{

        function showAlimentos(){
            $requisicao = new RequisicaoAlimentos();
            include_once $_SESSION["root"].'php/View/ViewEditarAlimentos.php';
        }

        function modAlimentos(){
            $requisicao = new RequisicaoAlimentos();
            if(isset($_POST['editar'])){
                $retorno = $requisicao->editAlimento();
                //$this->debug($retorno);
                if($retorno==0){
                    $_SESSION["flash"]["msg"]="Não foi possível editar o alimento";
                    $_SESSION["flash"]["sucesso"]=false;
                }else{
                    $_SESSION["flash"]["msg"]="Você acabou de editar o alimento";
                    $_SESSION["flash"]["sucesso"]=true;
                }
                header("Location:editarAlimentos");
            }
            else if(isset($_POST['criar'])){
                $retorno = $requisicao->createAlimento();
                //debug($retorno);
                if($retorno==0){
                    $_SESSION["flash"]["msg"]="Não foi possível criar o alimento";
                    $_SESSION["flash"]["sucesso"]=false;
                    
                }else{
                    $_SESSION["flash"]["msg"]="Você acabou de criar um novo alimento com o ID: ".$retorno;
                    $_SESSION["flash"]["sucesso"]=true;
                }
                header("Location:novoAlimento");
            }
            else if(isset($_POST['deletar'])){
                $retorno = $requisicao->deleteAlimento();
                //debug($retorno);
                if($retorno==0){
                    $_SESSION["flash"]["msg"]="Não foi possível excluir o alimento";
                    $_SESSION["flash"]["sucesso"]=false;
                }else{
                    $_SESSION["flash"]["msg"]="Você acabou de excluir o alimento";
                    $_SESSION["flash"]["sucesso"]=true;
                }
                header("Location:editarAlimentos");
            }
        }
    }
?>