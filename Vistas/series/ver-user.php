<section class="card mt-4">
	<?php if (!empty($serie)): ?>	
		<div class="container">
			<section class="row mt-1" id="info-serie">
				<div class="col-4 col-md-12 text-light back-info" id="back-img" style="background-image: url('<?=config::APP_URI?>/storage/<?= str_replace(" ", "",$serie['titulo'])?>/images/<?=$serie['imagen']?> ');">
					<div class="row p-2 sinopsis-img-serie h-100 d-none d-md-flex">
						<div class="col-md-4 col-12 align-items-md-end">
							<img src="<?=config::APP_URI?>/storage/<?= str_replace(" ", "",$serie['titulo'])?>/images/<?=$serie['imagen']?>" class="img-serie ">
						</div>
						<div class="col-md-8">
							<h1 class="text-left text-light text-capitalize"><?= $serie['titulo']?></h1>
							<p class="sinopsis-serie"><?= $serie['sinopsis']?></p>
							<p class="info-serie idioma w-25 border-0"><?= $serie['idioma']  ?></p>
							<p class="info-serie estreno w-25 border-0"><?= $serie['estreno']  ?></p>
						</div>
						<div class="col-12 mt-5">
							<div class="my-2 justify-content-center d-flex">
								<?php if ($categorias = categorias_by_serie_id($serie['id'])): ?>
									<?php foreach ($categorias as $categoria): ?>
										<a class="mx-1 categoria"><?=$categoria['categoria']?></a>
									<?php endforeach ?>
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-8 d-block d-md-none">
					<div class="row">
						<div class="col-12 d-block d-md-none">
							<h1 class="text-dark text-capitalize h4 mt-2 pl-3"><?= $serie['titulo']?></h1>
							<div class="my-2 d-flex"> 
								<?php if ($categorias = categorias_by_serie_id($serie['id'])): ?>
									<?php foreach ($categorias as $categoria): ?>
										<a class="mx-1 categoria"><?=$categoria['categoria']?></a>
									<?php endforeach ?>
								<?php endif ?>
							</div>
						</div>
						<div class="col-12 d-block d-md-none">
							<p class="info-serie idioma w-100 border-0"><?= $serie['idioma']  ?></p>
							<p class="info-serie estreno w-100 text-light border-0"><?= $serie['estreno']  ?></p>
						</div>
						<div class="col-12 order-2 d-md-none d-block p-0">
							<p class="p-3">
								<?= $serie['sinopsis'] ?>
							</p>
						</div>
					</div>
				</div>
				
			</section>
			<!-- series - capitulos -->
			<section id="capitulos-serie" class="card-body p-0">
				<div class="mt-1">
					<?php if ($seasons): ?>
						<?php foreach ($seasons as $season): ?>
							<div id="temporadas">
								<div class="bg-dark text-light info-serie border-0 p-1 my-md-3">
									<p class="h5 text-center">Temporada <?= $season['season_num'] ?></p>
								</div>
								<div class="drop">
									<?php if ($capitulos): ?>
										<ul class="list-unstyled">
											<?php foreach ($capitulos as $capitulo): ?>
												<?php if ( $capitulo['season_id'] == $season['id'] && !isset($capitulo['status'])): ?>
													<li class="my-3 my-md-1 capitulos-list">
														<a href="/capitulo/ver/<?=$capitulo['id']?>" class="text-decoration-none py-1 px-2 d-block text-dark item-capitulo">Capitulo: <?=$capitulo['chapter_num']?> - <?=$capitulo['titulo']?></a>
													</li>
												<?php elseif ($capitulo['season_id'] == $season['id'] && isset($capitulo['status'])): ?>
													<p class="text-center">
													    <?= $capitulo['result'] ?>
													</p>
												<?php endif ?>
											<?php endforeach ?>
										</ul>
									<?php endif ?>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
			</section>
		</div>	
	<?php else: ?>
		<p>Serie no encontrada</p>
	<?php endif ?>
</section>