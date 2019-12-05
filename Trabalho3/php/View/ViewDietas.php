<?php 
$titulo="Dietas - ".$_SESSION["nomeLogado"];
include $_SESSION["root"].'includes/header.php';
?>
	<div class="limiter">
		<main class="container-main100">
			<div class="wrap-main100 m-t-50 m-b-50">
				<?php include $_SESSION["root"].'includes/menu.php';?>
				<section class="p-l-30 p-r-30">
					<span class="login100-form-title p-b-33">
			        	Dietas
			        </span>

			        <div class="escolheDieta row m-b-15">
			        	<?php 
				        	if(isset($retornoDietas)):
				        		foreach ($retornoDietas as $value):?>
								<div class="col-md-4 col-sm-6 dietaMostrada">
									<div class="panel panel-default">
										<div class="panel-heading" data-id=<?= $value->getIdDieta()?>>
											<h3 class="dietaTitle"><?= $value->getNome() ?></h3>
											<button class="dietaDelete icDelete">
												<i class="far fa-trash-alt"></i>
											</button>
										</div>
											
										<div class="panel-body">
											<p>Refeições: <?= $value->getTotalRefeicoes() ?></p>
											<p>Total calorias: <?= $value->getTotalKcal() ?></p>
										</div>
										<a href="refeicoes?idDieta=<?= $value->getIdDieta() ?>">
										<button type="button" class="login100-form-btn panel-footer">Visualizar</button></a>
									</div>
								</div>
								<?php endforeach; ?>
							<?php endif; ?>

						<div class="col-md-4 col-sm-6 form-newPanel">
							<div class="panel panel-default bgPanel">
								<div class="m-l-15 m-r-15 form-horizontal">
									<div class="row">
										<div class="col-xs-12 m-b-13_8">
											<label class="control-label" for="nome">Nome:</label>
											<div class="wrap-input100 validate-input" data-validate = "Nome necessário!">
												<input type="text" class="dadosColetados input100 nomeDieta" name="nome">
												<span class="focus-input100-1"></span>
												<span class="focus-input100-2"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6 m-b-15">
											<button type="button" class="login100-form-btn dietaSave" value="salvar" name="dietaSave">Salvar</button>
										</div>
										<div class="col-xs-6 m-b-15">
											<button type="button" class="login100-form-btn cancelar"  value="cancelar" name="cancelar">Cancelar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 btn-newPanel">
							<div class="panel panel-default bgPanel">
								<div class="plusBtnNew">
									<div class="iconNew"><i class="fas fa-plus"></i></div>
									<h4>Nova Dieta</h4>
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