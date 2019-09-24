<body class="bg-secondary">

  <!-- Page Content -->
  <?php
   
	if($_SERVER["REQUEST_METHOD"] == "POST") {	
		if(session_destroy()) {
			$_SESSION['logged'] = false;
			header("Location: index.php?page=home");
		}
	}
	
	if($_SESSION['logged'] == true){
	?>
		<div class="container">
			<header class="jumbotron my-4 bg-dark">
				<h1 class="display-3 text-success">Benvenuto <?php echo $_SESSION['username']; ?></h1>
				
			</header>
			
			<form action="" method="post">
				<button class="btn btn-lg btn-primary btn-block text-uppercase btn-success">Logout</h2>
			</form>
		</div>
		
	<?php
	}else{
		?>
		<div class="container">
			<header class="jumbotron my-4 bg-dark">
				<h1 class="display-3 text-success">Credenziali errate, riprova l'accesso.</h1>
			</header>
		</div>
	<?php
	}
		?>
</body>
