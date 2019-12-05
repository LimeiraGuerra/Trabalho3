<?php
$titulo="Login";
include $_SESSION["root"].'includes/header.php';
?>
<div class="limiter">
		<main class="container-main100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-50 p-b-50">
				<form action="postLogin" method="POST" class="login100-form validate-form">
					<span class="login100-form-title p-b-33">
						Login
					</span>
					<?php if(isset($_SESSION["flash"]["msg"])){
							if($_SESSION["flash"]["sucesso"]==false)
								echo"<div class='bg-danger text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							else{
								echo"<div class='bg-success text-center msg'>".$_SESSION["flash"]["msg"]."</div>";
							}
						} ?>

					<div class="wrap-input100 validate-input" data-validate = "Login necessário!">
						<input class="input100" type="text" name="login" id="login" placeholder="Login*" value=<?php if(isset($_SESSION["flash"]["login"]))echo $_SESSION["flash"]["login"];?>>
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Senha necessária!">
						<input class="input100" type="password" name="senha" id="pwd" placeholder="Senha*">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button type="submit" class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-5">
						<span class="txt1">
							Criar uma conta?
						</span>

						<a href="cadastro" class="txt2 hov1">
							Inscreva-se
						</a>
					</div>
				</form>
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
