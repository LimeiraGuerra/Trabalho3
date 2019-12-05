<?php 
session_start();
$titulo=$_GET["nome"];
include $_SESSION["root"].'includes/header.php';
include_once $_SESSION["root"].'Utils/Utils.php';
include 'requisicaoCurlClasse.php';
include 'ModelRefeicoes.php';

$requisicao = new RequisicaoRefeicoes();
$retorno = json_decode($requisicao->getRefeicaoById($_GET["idRef"]), true);

$refeicao = new ModelRefeicoes();
$keys = array_keys($retorno[0]);
$refeicao->setIdRefeicao($retorno[0][$keys[0]]);
$refeicao->setNome($retorno[0][$keys[1]]);
$refeicao->setIdDieta($retorno[0][$keys[2]]);
$refeicao->setAllAlimentos($retorno[0][$keys[3]]);
?>
	<div class="limiter">
		<main class="container-main100">
			<div class="wrap-main100 m-t-50 m-b-50">
				<section class="p-l-30 p-r-30">
					<span class="login100-form-title p-b-33 p-t-30" style="z-index: 10; position: relative;">
			        	<?= $_GET["nome"];?>
			        </span>      
			      
			        <div class="escolheAlimento row m-b-15" data-id=<?= $_GET["idRef"];?>>
			        	
						<div class="col-sm-12 refeicaoSolo">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="refTitle">Alimentos:</h3>
								</div>				
								<div class="panel-body row">
									<div class="alimentosTabela">
										<table class="col-xs-12 table table-hover">
											<thead>
												<tr>
													<th></th>
													<th>Gramas</th>
													<th>Proteinas</th>
													<th>Carboidratos</th>
													<th>Gorduras</th>
													<th>Fibras</th>
													<th>Umidade</th>
													<th>Calorias</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php  
												$totais = [0, 0, 0, 0, 0, 0, 0];
												if(isset($refeicao) && $refeicao != null):
								        		foreach ($refeicao->getAllAlimentos() as $key => $value):
								        			$totais[0] += $value[1];
								        			$totais[1] += $value[2];
								        			$totais[2] += $value[3];
								        			$totais[3] += $value[4];
								        			$totais[4] += $value[5];
								        			$totais[5] += $value[6];
								        			$totais[6] += $value[7];
									        	?>
												<tr data-id=<?= $key?>>
													<td><?= $value[0]?></td>
													<td><?= $value[1]?></td>
													<td><?= $value[2]?></td>
													<td><?= $value[3]?></td>
													<td><?= $value[4]?></td>
													<td><?= $value[5]?></td>
													<td><?= $value[6]?></td>
													<td><?= $value[7]?></td>
													<td>
														<button class="alimentoDelete">
															<i class="far fa-trash-alt"></i>
														</button>
													</td>
												</tr>
												<?php endforeach; ?>
											<?php endif; ?>
											</tbody>
											<tfoot>
												<tr>
													<th>Total:</th>
													<td><?= $totais[0]?></td>
													<td><?= $totais[1]?></td>
													<td><?= $totais[2]?></td>
													<td><?= $totais[3]?></td>
													<td><?= $totais[4]?></td>
													<td><?= $totais[5]?></td>
													<td><?= $totais[6]?></td>
													<td></td>
												</tr>
											</tfoot>
										</table>
									</div>
									<form class="form-horizontal formAddAlimento col-xs-12" action="addAlimRef" method="POST">
			        					<div class="row">
			                				<div class="form-row">
			                					<div class="col-sm-12 m-b-15">
			                						<label class="control-label" for="nome">Adicionar um alimento:</label>
			                    					<div class="wrap-input100">
			                        					<input type="text" class="dadosColetados input100" id="buscar" name="buscar" placeholder="Digite o nome de um alimento (pelo menos 3 caracteres)">
			                        					<span class="focus-input100-1"></span>
														<span class="focus-input100-2"></span>
			                    					</div>
			                					</div>
			                				</div>
			                				<div id="esconder">
				                				<div class="form-row m-l-10 m-r-10 m-b-10">
				                					<input type="hidden" name="idAlimento" id="id">
					                				<div class="col-xs-12 col-sm-2 m-b-15">
									                    <label class="control-label" for="Proteinas">Proteinas*:</label>
									                    <div class="wrap-input100 input100-disable" >
									                        <input type="text" class="dadosColetados input100" id="Proteinas"  name="Proteinas" readonly>
									                    </div>
									                </div>
													<div class="col-xs-12 col-sm-2 m-b-15">
									                    <label class="control-label" for="Carboidratos">Carboidratos*:</label>
									                    <div class="wrap-input100 input100-disable" >
									                        <input type="text" class="dadosColetados input100" id="Carboidratos"  name="Carboidratos" readonly>
									                    </div>
									                </div>
													<div class="col-xs-12 col-sm-2 m-b-15">
									                    <label class="control-label" for="Gorduras">Gorduras*:</label>
									                    <div class="wrap-input100 input100-disable" >
									                        <input type="text" class="dadosColetados input100" id="Gorduras"  name="Gorduras" readonly>
									                    </div>
									                </div>
													<div class="col-xs-12 col-sm-2 m-b-15">
									                    <label class="control-label" for="Fibra">Fibras*:</label>
									                    <div class="wrap-input100 input100-disable" >
									                        <input type="text" class="dadosColetados input100" id="Fibra"  name="Fibra" readonly>
									                    </div>
									                </div>
													<div class="col-xs-12 col-sm-2 m-b-15">
									                    <label class="control-label" for="umidade">Umidade*:</label>
									                    <div class="wrap-input100 input100-disable">
									                        <input type="text" class="dadosColetados input100" id="umidade"  name="umidade" readonly>
									                    </div>
									                </div>
													<div class="col-xs-12 col-sm-2 m-b-15">
									                    <label class="control-label" for="Calorias">Calorias*:</label>
									                    <div class="wrap-input100 input100-disable" >
									                        <input type="text" class="dadosColetados input100" id="Calorias"  name="Calorias" readonly>
									                    </div>
									                </div>
													<div class="avisoSelect col-xs-12 col-sm-12">
														<p><i>*referente a porção de 100g</i></p>
													</div>
				                				</div>
				                				<div class="col-xs-12 col-sm-4 m-b-15">
													<div class="wrap-input100 validate-input" data-validate = "Quantidade necessária!">
														<input type="text" class="dadosColetados input100 qdtGrama" id="buscar" name="qdtGrama" placeholder="Quantidade em gramas">
														<span class="focus-input100-1"></span>
														<span class="focus-input100-2"></span>
													</div>
												</div>
												<div class="col-xs-12 col-sm-4 m-b-15 m-t-5">
													<button type="button" class="login100-form-btn addAlimento" value="addAlimento" name="addAlimento">Adicionar</button>
												</div>
												<div class="col-xs-12 col-sm-4 m-b-15 m-t-5">
													<button type="button" class="login100-form-btn cancelaA"  value="cancelaA" name="cancelaA">Cancelar</button>
												</div>
											</div>
			            				</div>
			        				</form>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
let alimentosJS = <?php echo json_encode($retorno[1]); ?>;
</script>
<script src="includes/js/autocomplete.js"></script>
