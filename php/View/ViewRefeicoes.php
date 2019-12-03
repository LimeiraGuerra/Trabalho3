<?php 
$titulo=$dietaNome." - ".$_SESSION["nomeLogado"];
include $_SESSION["root"].'includes/header.php';
include_once $_SESSION["root"].'php/Utils/Utils.php';
?>
	<div class="limiter">
		<main class="container-main100">
			<div class="wrap-main100 m-t-50 m-b-50">
				<?php include $_SESSION["root"].'includes/menu.php';?>
				<section class="p-l-30 p-r-30">
					<span class="login100-form-title p-b-33" style="z-index: 10; position: relative;">
			        	<?php echo $dietaNome;?>
			        </span>      
			        <div id="chart_container">
      					<div id="pie-chart" class="chart-div" style="height: 300px; margin-top: -50px; margin-bottom: 30px;"></div>
      				</div>
			        <div class="escolheRefeicao row m-b-15" data-id=<?php echo $_GET["idDieta"];?>>
			        	<?php  
			        		if(isset($retornoRefeicoes)):
			        			$totais = [0, 0, 0, 0, 0, 0];
				        		foreach ($retornoRefeicoes as $value):
				        			//Utils::debug($value->getAllAlimentos());
				        			$ttRef = $value->getTotalMacros();
				        			$totais[0] += $ttRef[0];
				        			$totais[1] += $ttRef[1];
				        			$totais[2] += $ttRef[2];
				        			$totais[3] += $ttRef[3];
				        			$totais[4] += $ttRef[4];
				        			$totais[5] += $ttRef[5];
				        			?>
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
										<a href="refeicaoSolo?idRef=<?= $value->getIdRefeicao()?>">
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	var chartValues = <?php echo (isset($totais)) ? json_encode($totais) : 'null'; ?>;
	
	if (chartValues != null && !chartValues.every(function(val){return val == 0})) {

	    google.charts.load('current', {'packages':['corechart']});
	      
	    google.charts.setOnLoadCallback(drawPieChart);
	      
	    function drawPieChart() {

	      var data = new google.visualization.arrayToDataTable([
	        ["Macro",			   "Valores"],
	        ['Proteinas',     chartValues[0]],
	    	['Carboidratos',  chartValues[1]],
	    	['Gorduras',  	  chartValues[2]],
	    	['Fibras', 		  chartValues[3]],
	    	['Umidade',       chartValues[4]],
	    	['Calorias',      chartValues[5]]
	        ]);

	      var options = {	
	          titlePosition: 'none',
	          width: '100%',
	          height: '100px',
	          legend: { position: 'bottom'},
	        };
	      var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
	      chart.draw(data, options);
	    }
	}else{
		$('#chart_container').hide();
	}
</script>
