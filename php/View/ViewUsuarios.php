<?php 
$titulo="Usuarios - ".$_SESSION["nomeLogado"];
include $_SESSION["root"].'includes/header.php';
?>
	<div class="limiter">
		<main class="container-main100">
			<div class="wrap-main100 m-t-50 m-b-50">
				<?php include $_SESSION["root"].'includes/menu.php';?>
				<section class="p-l-30 p-r-30">
					<span class="login100-form-title p-b-33">
			        	Usuários
			        </span>

			        <div class="tabelaUsers m-b-30">
			        	<table class="table centerTable table-hover">
			        		<thead>
				        		<tr>
				        			<th>Id</th>
				        			<th>Nome</th>
				        			<th>Login</th>
				        			<th>Moderador?</th>
				        		</tr>
			        		</thead>
			        		<tbody>
			        			<?php foreach ($usuarios as $value): ?>
				        		<tr>
				        			<td><?= $value->getIdUsuario() ?></td>
				        			<td><?= $value->getNome() ?></td>
				        			<td><?= $value->getLogin() ?></td>
				        			<td><input type="checkbox" name="moderador" value="<?= $value->getIdUsuario() ?>" class="ckbModerador" <?= $value->isModerador() ? 'checked' : '' ?> /></td>
				        		</tr>
				        		<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        </div>
			    </section>
			</div>
		</main>
	</div>

<?php 
	include $_SESSION["root"].'includes/footer.php';
?>