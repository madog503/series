<div class="card border-0">
	<div class="card-header">
			<button class="btn btn-info btn-block p-2" id="add-other"> <?= isset($update)? 'actualizar capitulo':'Agregar otro capitulo'; ?></button>
	</div>
	<div class="card-body">
		<form action="<?= isset($update)? '/capitulo/update':'/capitulo/bulkSave'; ?>" method="POST" id="form-new-capitulo">
			<div class="new-capitulo">
				<?php if (isset($update)): ?>
					<input type="hidden" class="capitulo-input" name="capitulo[0][id]" value="<?=$id?>">
				<?php endif ?>
				<input type="hidden" class="capitulo-input" name="capitulo[0][serie_id]" value="<?=isset($update)? $update['serie_id']:$serie_id;?>">
				<input type="hidden" class="capitulo-input" name="capitulo[0][season_id]" value="<?=isset($update)? $update['season_id']:$season_id;?>">
				<input type="hidden" class="capitulo-input" name="capitulo[0][token]" id="token" value="<?=$token?>">
				<input type="text" class="capitulo-input form-control my-1" name="capitulo[0][titulo]" placeholder="titulo del capitulo" value="<?= isset($update)? $update['titulo']:''; ?>">
				<input type="text" class="capitulo-input form-control my-1" name="capitulo[0][chapter_num]" placeholder="numero de capitulo" value="<?= isset($update)? $update['chapter_num']:''; ?>">
				<input type="text" class="capitulo-input form-control my-1" name="capitulo[0][link]" placeholder="link" value="<?= isset($update)? $update['link']:''; ?>">
			</div>
		</form>
		<input type="submit" class="form-control bg-info mt-2" form="form-new-capitulo" value="<?= isset($update)? 'actualizar':'crear'; ?>">
	</div>
</div>