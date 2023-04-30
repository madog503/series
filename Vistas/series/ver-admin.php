<div class="card mt-3">
	<?php if ($serie): ?>
		<div class="card-header">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-6">
						<a class="info-panel-series my-1 bg-info text-center text-decoration-none d-block text-dark" href="serie_one.php?id=<?= $serie['id'] ?>"><?= $serie['titulo'] ?> </a>
						<p class="info-panel-series my-1 bg-warning text-center"><?= $serie['sinopsis'] ?> </p>
						<p class="d-flex my-1">
							<span class="w-50 text-center info-panel-series bg-info">
								<?= $serie['idioma'] ?> 
							</span>
							<span class="w-50 text-center info-panel-series bg-info">
								<?= $serie['estreno'] ?>
							</span>
						</p>
					</div>
					<div class="col-12 col-md-6">
						<a href="/temporada/crear/<?= $serie['id'] ?>" class="info-panel-series bg-info w-100 text-decoration-none d-block text-center text-light">Nueva Temporada</a>
						<a href="/serie/actualizar/<?=$serie['id']?>" class="info-panel-series bg-info w-100 text-decoration-none d-block text-center text-light my-1 ">actualizar</a>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<?php if ($seasons): ?>
				<ul class="list-unstyled">
					<?php foreach ($seasons as $season): ?>
						<li class="p-2 d-flex justify-content-between temporada_title my-1"> 
							<span class="text-uppercase align-self-center">temporada <?=$season['season_num']?></span>
							<span>
								<a href="/mixdrop/index/<?=$season['id']?>/<?=$serie['id']?>" class=" link-capitulo text-dark">mixdrop</a>
								<a href="/capitulo/crear/<?=$serie['id']?>/<?=$season['id']?>" class=" link-capitulo text-dark mx-1">nuevo capitulo</a>
								<a href="/temporada/delete/<?=$season['id']?>" class=" link-capitulo text-dark" >borrar</a>
							</span>
						</li>
						<li>
							<ul class="list-unstyled">
								<?php foreach ($capitulos as $capi): ?>
									<?php if ( $capi['season_id'] == $season['id'] && !isset($capi['status'])): ?>
										<li class="py-1 d-flex">
											<a href="/capitulo/ver/<?=$capi['id']?>"  class="w-100 d-block text-decoration-none link-capitulo text-dark">
												Capitulo: <?=$capi['chapter_num']?> - <?=$capi['titulo']?>
											</a>
											<a href="/capitulo/delete/<?=$id?>/<?=$capi['id']?>" class="mx-1 link-capitulo borrar">borrar</a>
											<a href="/capitulo/actualizar/<?=$id?>/<?=$capi['id']?>" class="link-capitulo actualizar">actualizar</a>
										</li>
									<?php elseif ($capi['season_id'] == $season['id'] && isset($capi['status'])): ?>
										    <?= $capi['result'] ?>
									<?php endif ?>
								<?php endforeach ?>
							</ul>
						</li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		</div>
	<?php else: ?>
		<div class="card-header">serie no encontrada</div>
	<?php endif ?>
</div>