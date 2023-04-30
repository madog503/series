<div class="card border-0">
	<div class="card-header">
			<button class="btn btn-info btn-block p-2" id="add-other">actualizar capitulo</button>
	</div>
	<div class="card-body">
		<form action="/capitulo/update" method="POST" id="form-new-capitulo">
			<div class="new-capitulo">
				<input type="hidden" class="capitulo-input" name="id" value="<?=$id?>">
				<input type="hidden" class="capitulo-input" name="serie_id" value="<?=isset($update)? $update['serie_id']:$serie_id;?>">
				<input type="hidden" class="capitulo-input" name="season_id" value="<?=isset($update)? $update['season_id']:$season_id;?>">
				<input type="hidden" class="capitulo-input" name="token" id="token" value="<?=$token?>">
				<input type="text" class="capitulo-input form-control my-1" name="titulo" placeholder="titulo del capitulo" value="<?= isset($update)? $update['titulo']:''; ?>">
				<input type="text" class="capitulo-input form-control my-1" name="chapter_num" placeholder="numero de capitulo" value="<?= isset($update)? $update['chapter_num']:''; ?>">
				<input type="text" class="capitulo-input form-control my-1" name="link" placeholder="link" value="<?= isset($update)? $update['link']:''; ?>">
			</div>
		</form>
		<input type="submit" class="form-control bg-info mt-2" form="form-new-capitulo" value="<?= isset($update)? 'actualizar':'crear'; ?>">
	</div>
</div>