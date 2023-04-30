
<div class="card">
	<div class="card-header bg-dark">
		<h2 class="text-light text-center"> <?= isset($login)? 'ingresar a mi perfil': 'nuevo usuario' ?> </h2>
	</div>
	<form action="<?= isset($login)? '/user/singin': '/user/save' ?>" method="POST">
		<div class="form-group">
			<label >User Name</label>
			<input type="text" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label >contraseña</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" class="form-control btn btn-info" value="<?= isset($login)? 'ingresar': 'crear' ?>">
		</div>
	</form>
</div>