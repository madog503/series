<div class="card mt-3">
	<div class="card-header bg-dark">
		<h2 class="text-light text-center"> <?= isset($update)?'actualizar serie':'nueva serie'?> </h2>
	</div>
	<div class="card-body">
		<form action="<?= isset($update)?'/serie/update':'/serie/save'?>" method='POST' enctype="multipart/form-data">
			<input type="hidden" name="token" value="<?=$token?>">
			<input type="hidden" name="user_id" value="<?=$user['id']?>">
			<input type="hidden" name="serie_id" value="<?= isset($serie)? $serie['id']:''?>">
			<div class="form-group">
				<label for="titulo">Titulo</label>
				<input type="text" id="titulo" name="titulo" class="form-control" value="<?= isset($serie)? $serie['titulo']:''?>">
			</div>
			<div class="form-group">
				<label for="sinopsis">sinopsis</label>
				<textarea id="sinopsis" name="sinopsis" class="form-control" rows="5"><?= isset($serie)? $serie['sinopsis']:''?></textarea>
			</div>
			<div class="form-group"> 
				<label for="idioma">idioma</label>
				<input type="text" id="idioma" name="idioma" class="form-control" value="<?= isset($serie)? $serie['idioma']:''?>">
			</div>
			<?php if (!isset($update)): ?>
				<div class="form-group"> 
					<label for="categoria">categorias</label>
					<select multiple="" name="categorias[]" id="categoria" class="form-control">
						<?php if ($categorias = categorias()): ?>
							<?php foreach ($categorias as $categoria): ?>
								<option value="<?=$categoria['id']?>"><?=$categoria['categoria']?></option>
							<?php endforeach ?>
						<?php else: ?>
							<option value="1">No hay categorias</option>
						<?php endif ?>
					</select>
				</div>
				<div class="form-group">
					<label for="imagen">imagen</label>
					<input type="file" id="imagen" name="imagen" class="form-control-file">
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="estreno">estreno</label>
				<input type="date" id="estreno" name="estreno" class="form-control" value="<?= isset($serie)? $serie['estreno']:''?>">
			</div>
			<div class="form-group">
				<input type="submit" value="<?= isset($update)?'actualizar':'crear'?>" class="form-control btn btn-info">
			</div>
		</form>
	</div>
</div>