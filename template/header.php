<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php?page=home">
		  <div class="col-lg-3 col-md-2 mb-1">
			  <img class="card-img-top" src="./premier.png">
		  </div>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=home">Home
            <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=match">Match</a>
          </li>
          <li class="nav-item">
			<?php
			if(isset($_SESSION['username'])){
				?>
				<a class="nav-link text-success" href="index.php?page=pannello_gestione"><b><?php echo $_SESSION['username']; ?></b></a>
			<?php
			}else{
				?>
            <a class="nav-link text-success" href="index.php?page=login&action=login"><b>Accedi</b></a>
			<?php
			}
				?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
