<?php 
$titulo="Alimentos - ".$_SESSION["nomeLogado"];
include $_SESSION["root"].'includes/header.php';
?>
	<div class="limiter">
		<main class="container-main100">
			<div class="wrap-main100 m-t-50 m-b-50">
				<?php include $_SESSION["root"].'includes/menu.php';?>
				<section class="p-l-30 p-r-30" id="form2">
					<span class="login100-form-title p-b-33">
			        	Encontrar Alimento para Editar ou Excluir
			    	</span>
			        <?php if(isset($_SESSION["flash"]["msg"])){
							if($_SESSION["flash"]["sucesso"]==false)
								echo"<div class='bg-danger text-center msg form-align'>".$_SESSION["flash"]["msg"]."</div>";
							else{
								echo"<div class='bg-success text-center msg form-align'>".$_SESSION["flash"]["msg"]."</div>";
							}
						} ?>
			        <form class="form-horizontal formCrud" action="modAlimentos" method="POST">
			        	<div class="row m-b-15">
			                <div class="form-row">
			                	<div class="col-sm-12 m-b-15">
			                    	<div class="wrap-input100">
			                        	<input type="text" class="dadosColetados input100" id="buscar"  name="buscar" placeholder="Digite o nome de um alimento (pelo menos 3 caracteres)">
			                        	<span class="focus-input100-1"></span>
										<span class="focus-input100-2"></span>
			                    	</div>
			                	</div>
			                </div>

				            <div id="esconder" class="m-t-15">
				                <div class="form-row">
				                	<div class="col-sm-2 m-b-15">
				                    	<label class="control-label" for="id">Id:</label>
				                    	<div class="wrap-input100 input100-disable">
				                        	<input type="text" class="dadosColetados input100" id="id"  name="id" readonly>
				                    	</div>
				                	</div>
				                	<div class="col-sm-10 m-b-15">
				                    	<label class="control-label" for="nome">Nome:</label>
				                    	<div class="wrap-input100 validate-input" data-validate = "Nome necessário!">
				                        	<input type="text" class="dadosColetados input100" id="nome" name="nome">
				                        	<span class="focus-input100-1"></span>
											<span class="focus-input100-2"></span>
				                    	</div>
				                	</div>
				                </div>            
				               <div class="form-row">
					                <div class="col-sm-6 m-b-15">
					                    <label class="control-label" for="Proteinas">Proteinas:</label>
					                    <div class="wrap-input100 validate-input" data-validate = "Valor real necessário!">
					                        <input type="text" class="dadosColetados input100" id="Proteinas"  name="Proteinas">
					                        <span class="focus-input100-1"></span>
											<span class="focus-input100-2"></span>
					                    </div>
					                </div>
					                <div class="col-sm-6 m-b-15">
					                    <label class="control-label" for="Carboidratos">Carboidratos:</label>
					                    <div class="wrap-input100 validate-input" data-validate = "Valor real necessário!">
					                        <input type="text" class="dadosColetados input100" id="Carboidratos"  name="Carboidratos">
					                        <span class="focus-input100-1"></span>
											<span class="focus-input100-2"></span>
					                    </div>
					                </div>
					            </div>
				                <div class="form-row ">
					                <div class="col-sm-6 m-b-15">
					                    <label class="control-label" for="Gorduras">Gorduras:</label>
					                    <div class="wrap-input100 validate-input" data-validate = "Valor real necessário!">
					                        <input type="text" class="dadosColetados input100" id="Gorduras"  name="Gorduras">
					                        <span class="focus-input100-1"></span>
											<span class="focus-input100-2"></span>
					                    </div>
					                </div>
					                <div class="col-sm-6 m-b-15">
					                    <label class="control-label" for="Fibra">Fibras:</label>
					                    <div class="wrap-input100 validate-input" data-validate = "Valor real necessário!">
					                        <input type="text" class="dadosColetados input100" id="Fibra"  name="Fibra">
					                        <span class="focus-input100-1"></span>
											<span class="focus-input100-2"></span>
					                    </div>
					                </div>
					            </div>
				                <div class="form-row ">
				                	<div class="col-sm-6 m-b-15">
					                    <label class="control-label" for="umidade">Umidade:</label>
					                    <div class="wrap-input100 input100-disable">
					                        <input type="text" class="dadosColetados input100" id="umidade"  name="umidade" placeholder="*Calcular" readonly>
					                    </div>
					                </div>
					                <div class="col-sm-6 m-b-15">
					                    <label class="control-label" for="Calorias">Calorias:</label>
					                    <div class="wrap-input100 input100-disable" >
					                        <input type="text" class="dadosColetados input100" id="Calorias"  name="Calorias" placeholder="*Calcular" readonly>
					                    </div>
					                </div>
					            </div>
				                <div class="form-row ">        
				                    <div class="col-sm-4 m-b-15">
	                        			<button type="button" class="login100-form-btn" value="calcular" name="calcular" id="calcular">Calcular</button>
	                        		</div>
				                       
				                    <div class="col-sm-4 m-b-15">
				                        <button type="submit" class="login100-form-btn" value="editar" name="editar" id="criar">Editar</button>
				                    </div>
				                    <div class="col-sm-4 m-b-15">
				                        <button type="submit" class="login100-form-btn login100-form-btn-danger deletarBtn"  value="deletar" name="deletar">Deletar</button>
				                    </div>
				                </div>
				            </div>
				        </div>
			        </form>
			    </section>
			</div>
		</main>
	</div>

<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"] )){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
//passo todos os alimentos do PHP para o JS
let alimentosJS = <?php echo $requisicao->getAllAlimentos(); ?>;
</script>
<script src="includes/js/autocomplete.js"></script>

