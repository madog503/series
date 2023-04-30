<?php if ($series): ?>
		<div class="row">
			<?php foreach ($series as $serie): ?>
				<div class="col-6 col-sm-4 col-md-3 my-2">
					<div class="post">
						<div class="content-img">
							<a href="/serie/ver/<?=$serie['id']?>" class="w-100 h-100">
							<img src="<?=config::APP_URI?>/storage/<?= str_replace(" ", "",$serie['titulo'])?>/images/<?=$serie['imagen']?>" alt="" class="post-img">
							</a>
						</div>
						<div class="info text-capitalize">
		    				<?= $serie['titulo'] ?>
		  				</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	<?php else: ?>
		<p>no hay series</p>
	<?php endif ?>

