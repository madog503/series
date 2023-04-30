<nav class="navbar navbar-expand-md bg-dark navbar-dark">

	<div class="container">
		  <a class="navbar-brand" href="/home/index">Inicio</a>

		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menucollapse">
		    <span class="navbar-toggler-icon"></span>
		  </button>

			<div class="collapse navbar-collapse" id="menucollapse">
			    <ul class="navbar-nav w-100">
					<li class="nav-item">
						<a class="nav-link" href="#">Estrenos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Peliculas</a>
					</li>
					<!-- Dropdown -->
				  	<?php if($categorias = categorias()): ?>
						<li class="nav-item dropdown">
						  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						    Categorias
						  </a>

						  <div class="dropdown-menu">
						  	<?php foreach ($categorias as $categoria): ?>
						    	<a class="dropdown-item" href="#"><?= $categoria['categoria']?></a>
						  	<?php endforeach ?>
						  </div>
						</li>
					<?php endif ?>
					<?php if (isset($user)): ?>
						<li class="nav-item dropdown ml-md-auto">
						  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						    <?= $user['username'] ?>
						  </a>
						  <div class="dropdown-menu dropdown-menu-right">
						  	<?php if ($user['role'] == 3): ?>
					    	<a class="dropdown-item" href="/serie/crear">nueva serie</a>
					    	<a class="dropdown-item" href="/categoria/crear">nueva categoria</a>
					    	<a class="dropdown-item" href="/user/crear">nuevo usuario</a>
					    	<a class="dropdown-item" href="/serie/listar">panel</a>
						  	<?php endif ?>
					    	<a class="dropdown-item" href="/user/singout">cerrar session</a>
						  </div>
						</li>
					<?php endif ?>
			    </ul>
			</div>
	</div>  
</nav>

<?php if (isset($_SESSION['message'])): ?>
	<p class="bg-success"> <?= $_SESSION['message'] ?> </p>
<?php elseif(isset($_SESSION['error'])): ?>
	<p class="bg-danger"> <?= $_SESSION['error'] ?> </p>
<?php endif ?>