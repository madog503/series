	<div class="new-capitulo my-2 border border-dark border-2 p-2" id="mix<?=$key?>">
		<button class="btn btn-info btn-block p-1" onclick="mix_remove_input(<?=$key?>)">remover</button>

		<!-- start input -->
		<input type="hidden" class="capitulo-input" id="mix <?=$key?>" name="capitulo[<?=$key?>][serie_id]" value="<?=$this->serie_id?>">
		<input type="hidden" class="capitulo-input" id="mix<?=$key?>" name="capitulo[<?=$key?>][season_id]" value="<?=$this->season_id?>">
		<input type="hidden" class="capitulo-input" id="mix<?=$key?>" name="capitulo[<?=$key?>][token]" value="<?=$token?>">
		<label for="" class="col-form-label">titulo</label>
		<input type="text" class="capitulo-input form-control my-1" name="capitulo[<?=$key?>][titulo]" placeholder="titulo del capitulo" value="<?=$value['title']?>">
		<label for="" class="col-form-label">numero de capitulo</label>
		<input type="text" class="capitulo-input form-control my-1" name="capitulo[<?=$key?>][chapter_num]" placeholder="numero de capitulo" value="<?=$key+1?>">
		<label for="" class="col-form-label">link</label>
		<input type="text" class="capitulo-input form-control my-1" name="capitulo[<?=$key?>][link]" placeholder="link" value="<?=$value['url']?>">
		<!-- end input -->
	</div>