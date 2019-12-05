<?php
    //Incluo classe de que sabe conversar com a API
    include 'requisicaoCurlClasse.php';
    
    //Crio o obj usarei para fazer as requisições
    $requisicao = new RequisicaoRefeicoes();

    //O GetAll já chamado para popular a lista em JS. Olhar a variavel alimentosJS
    //O GetByID não é usado nesse exemplo. Descomentem as linhas para ver a saída
    //debug($requisicao->getAllAlimentos());
    //debug($requisicao->getAlimentoById(44));

    //Dependendo de qual form é enviado, chamo o método correspondente
    if(isset($_POST['criar'])){
        $retorno = $requisicao->createRefeicao();
        //debug($retorno);
        echo $retorno;
    }

    else if(isset($_POST['editar'])){
        $retorno = $requisicao->editRefeicao();
        //debug($retorno);
        echo $retorno;
    }
    else if(isset($_POST['deletar'])){
        $retorno = $requisicao->deleteRefeicao();
        //debug($retorno);
        echo $retorno;
    }   
?>