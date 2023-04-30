<div class="card">
	<form action="/capitulo/bulkSave" method="POST" id="form-new-capitulo">
		<?php 
			foreach ($datos as $key => $value) {
				if (isset($value['fileref'])) {
					require 'includes/files.php';

				}elseif (isset($value['id'])) {
					require 'includes/folder.php';
				}
			}

		 ?>
	</form>
	<input type="submit" class="form-control bg-info mt-2" form="form-new-capitulo" value="Crear">
</div>