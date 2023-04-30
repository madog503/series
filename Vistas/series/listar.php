<div class="card mt-4">
	<div class="card-header bg-dark">
		<h2 class="text-center text-light">panel series</h2>
	</div>
	<ul class="list-unstyled p-0">
		<?php foreach ($series as $serie): ?>
		 <li class=" d-flex justify-content-between my-2"> 
		 	<a href="/serie/ver/<?= $serie['id'] ?>" class="text-dark w-100 link-capitulo">
		 		<?= $serie['titulo'] ?>
		 	</a>
		 	<a href="/serie/delete/<?= $serie['id'] ?>" class="link-capitulo borrar">
			 	borrar
	 		</a> 
		 </li>
		<?php endforeach ?>
	</ul>
</div>