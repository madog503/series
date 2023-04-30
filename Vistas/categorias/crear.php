<div class="card mt-3">
	<div class="card-header bg-dark">
		<h2 class="text-light text-center"> <?= isset($update)? 'actualizar': 'crear' ?> categoria</h2>
	</div>
	<div class="card-body">
		<form action="<?= isset($update) && isset($categoria)? "/categoria/update/".$categoria['id']: '/categoria/save' ?>" method='POST'>
			<div class="form-group">
				<label for="categoria">categoria</label>
				<input type="text" id="categoria" name="categoria" class="form-control" value="<?= isset($categoria)? $categoria['categoria']: '' ?>">
			</div>
			<div class="form-group">
				<input type="submit" value="Enviar" class="form-control btn btn-info">
			</div>
		</form>
		<div class="mt-4">
			<div class="w-100 bg-dark p-2 text-light">Categorias</div>
			<ul class="list-unstyled">
				<?php if ($categorias = categorias()): ?>
					<?php foreach ($categorias as $categoria): ?>
						<li class="py-1 px-1 d-flex my-1">
							<a href="#" class="w-100 d-block text-decoration-none link-capitulo text-dark">
								<?= $categoria['categoria'] ?>
							</a>
							<a href="/categoria/actualizar/<?= $categoria['id'] ?>" class="link-capitulo actualizar text-decoration-none">actualizar</a>
						</li>		
					<?php endforeach ?>
				<?php endif ?>
			</ul>
		</div>
	</div>
</div>