<p class="my-2 border border-dark d-flex justify-content-between p-1">
	titulo : <?= $value['title'] ?>
	<a href=" <?= $this->link_($value) ?> ">
		<?=isset($value['id'])? $value['id'] : (isset($value['fileref'])? $value['fileref'] : '')?>
	</a>
</p>