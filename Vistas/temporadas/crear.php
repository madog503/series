<div class="card mt-3">
	<div class="card-header bg-dark">
		<h2 class="text-light text-center">nueva temporada</h2>
	</div>
	<div class="card-body">
		<form action="/temporada/save" method="POST">
				<input type="hidden" name="serie_id" value="<?= $serie_id ?>" class="form-control">
				<input type="hidden" name="token" value="<?= $token ?>" class="form-control">
				<input type="text" name="season_num" class="form-control" placeholder="Numero de la nueva temporada">
				<input type="submit" class="form-control bg bg-info" value="crear">
		</form>
	</div>
</div>