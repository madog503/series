<div class="card">
	<div class="card-header bg-dark rounded">
		<h1 class="text-center h3 text-light">
			Capitulo:
			<?= $player['chapter_num'] ?>
			-
			<?= $player['titulo'] ?>
			<!--  -->
		</h1>
	</div>
	<div class="d-flex justify-content-between align-items-center bg-warning mt-2 rounded"> 
		<div class=" w-25 text-left capitulo-navigation">
			<?php if (isset($links['anterior']) && $links['anterior']): ?>
				<a href="/capitulo/ver/<?=$links['anterior']?>" class="h2 py-1 d-block mx-4 my-1 rounded text-dark" ><i class="fa-solid fa-angle-left"></i></a>
			<?php endif ?>
		</div>
		<div class=" w-50 text-center capitulo-navigation">
			<a href="/serie/ver/<?=$player['serie_id']?>" class="h2 py-1 d-block mx-4 my-1 rounded text-dark" ><i class="fa-solid fa-bars"></i></a>
			
		</div>
		<div class=" w-25 text-right capitulo-navigation">
			<?php if (isset($links['siguiente']) && $links['siguiente']): ?>
				<a href="/capitulo/ver/<?=$links['siguiente']?>" class="h2 py-1 d-block mx-4 my-1 rounded text-dark" ><i class="fa-solid fa-chevron-right"></i></a>
			<?php endif ?>
		</div>
	</div>
	<div class="card-body">
		<?php if (preg_match('/\/\/mixdrop\.gl\//', $player['link'])): ?>
			<iframe width="100%" height="480" src="<?=$player['link']?>" scrolling="no" frameborder="0" allowfullscreen="true"></iframe>
		<?php else: ?>
			<p>NO hay reproductor disponible</p>	
		<?php endif ?>
		<div class="w-100 p-3" id="video"></div>
	</div>
</div>
