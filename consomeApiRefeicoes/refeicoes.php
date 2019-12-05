<?php 
$titulo="Refeições";
session_start();
if (!isset($_SESSION["root"])) {
	$_SESSION["root"] = 'C:/xampp/htdocs/php/consomeApiRefeicoes/';
}
include $_SESSION["root"].'includes/header.php';
include_once $_SESSION["root"].'Utils/Utils.php';
include 'requisicaoCurlClasse.php';
include 'ModelRefeicoes.php';

$requisicao = new RequisicaoRefeicoes();
$retorno = json_decode($requisicao->getAllRefeicoes(), true);

$retornoRefeicoes = array();

foreach ($retorno as $key => $value) {
	$ref = new ModelRefeicoes();
	$keys = array_keys($value);
	$ref->setIdRefeicao($value[$keys[0]]);
	$ref->setNome($value[$keys[1]]);
	$ref->setIdDieta($value[$keys[2]]);
	$ref->setAllAlimentos($value[$keys[3]]);

	$retornoRefeicoes[] = $ref;
}

//Utils::debug($retornoRefeicoes);


?>
	<div class="limiter">
		<main class="container-main100">
			<div class="wrap-main100 m-t-50 m-b-50">
				<section class="p-l-30 p-r-30">
					<span class="login100-form-title p-b-33 p-t-30" style="z-index: 10; position: relative;">
			        	Refeições
			        </span>      
			        <div class="escolheRefeicao row m-b-15">
			        	<?php  
			        		if(isset($retornoRefeicoes) && $retornoRefeicoes != null):
			        			$totais = [0, 0, 0, 0, 0, 0];
				        		foreach ($retornoRefeicoes as $key => $value):
				        			//Utils::debug($value->getAllAlimentos());
				        			$ttRef = $value->getTotalMacros();?>

								<div class="col-sm-12 refeicaoMostrada">
									<div class="panel panel-default">
											<div class="panel-heading" data-id=<?= $value->getIdRefeicao()?>>
											<h3 class="refTitle"><?= $value->getNome() ?></h3>
											<button class="refDelete icDelete">
												<i class="far fa-trash-alt"></i>
											</button>
										</div>				
										<div class="panel-body row totalRef">
											<div class="proteinasTT col-xs-6 col-sm-2">
												<h5>Proteinas: </h5>
												<p><?= $ttRef[0] ?></p>
											</div>
											<div class="carboidratosTT col-xs-6 col-sm-2">
												<h5>Carboidratos: </h5>
												<p><?= $ttRef[1] ?></p>
											</div>
											<div class="gordurasTT col-xs-6 col-sm-2">
												<h5>Gorduras: </h5>
												<p><?= $ttRef[2] ?></p>
											</div>
											<div class="fibrasTT col-xs-6 col-sm-2">
												<h5>Fibras: </h5>
												<p><?= $ttRef[3] ?></p>
											</div>
											<div class="umidadeTT col-xs-6 col-sm-2">
												<h5>Umidade: </h5>
												<p><?= $ttRef[4] ?></p>
											</div>
											<div class="caloriasTT col-xs-6 col-sm-2">
												<h5>Calorias: </h5>
												<p><?= $ttRef[5] ?></p>
											</div>
								
										</div>
										<a href="refeicaoSolo.php?idRef=<?= $value->getIdRefeicao()?>&nome=<?= $value->getNome()?>">
											<button type="button" class="login100-form-btn panel-footer">Visualizar</button>
										</a>
									</div>
								</div>
								<?php endforeach; ?>
							<?php endif; ?>
						<div class="col-xs-12 form-newPanel">
							<div class="panel panel-default bgPanel">
								<div class="m-l-15 m-r-15 form-horizontal">
									<div class="row">
										<div class="col-xs-12 m-b-25">
											<label class="control-label" for="nome">Nome:</label>
											<div class="wrap-input100 validate-input" data-validate = "Nome necessário!">
												<input type="text" class="dadosColetados input100 nomeDieta" name="nome">
												<span class="focus-input100-1"></span>
												<span class="focus-input100-2"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6 m-b-25">
											<button type="button" class="login100-form-btn salvar refSave" value="salvar" name="salvar">Salvar</button>
										</div>
										<div class="col-xs-6 m-b-25">
											<button type="button" class="login100-form-btn cancelar"  value="cancelar" name="cancelar">Cancelar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 btn-newPanel">
							<div class="panel panel-default bgPanel">
								<div class="plusBtnNew">
									<div class="iconNew"><i class="fas fa-plus"></i></div>
									<h4>Nova Refeição</h4>
								</div>
							</div>
						</div>
			        </div>
			    </section>
			</div>
		</main>
	</div>

<?php 
	include $_SESSION["root"].'includes/footer.php';
?>

<script type="text/javascript" src="includes/js/panels.js"></script>
