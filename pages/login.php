<body class="bg-secondary">
<?php
	include("script/connection.php");
	$action = $_GET['action'];
	if ($action == "login")
	{
		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$username = $_POST['username'];
			$password = $_POST['password'];
			$_SESSION['logged'] = false;

			$query = "SELECT *
					FROM utenti
					WHERE username = '$username'
					AND password = '$password'";
			$result = $mysqli->query($query) or die (mysql_error());
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);

			if($count == 1) {
				$_SESSION['username'] = $row['username'];
				$_SESSION['logged'] = true;
			}

			header("location: index.php?page=pannello_gestione");
		}
	?>
		<div class="container above-nav">
			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
					<div class="card card-signin my-5 bg-dark">
						<div class="card-body">
							<h5 class="card-title text-center text-success">Accedi</h5>
							<form class="form-signin" action="" method="post">
								<div class="form-label-group">

									<label class="text-success">Username</label>
									<input type="text" name="username" class="form-control" required autofocus>

								</div>
								<div class="form-label-group">

									<label class="text-success" >Password</label>
									<input type="password" name="password" class="form-control" required>

								</div>
								<br>
								<hr class="my-4">
								<button class="btn btn-lg btn-primary btn-block text-uppercase btn-success" type="submit">Accedi!</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}
	else
	{

		$query = "	SELECT *
					FROM abbonamenti
					ORDER BY prezzo ASC";
		$result = $mysqli->query($query);

		echo '<div class="row text-center">';
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
	?>
			<div class="container above-nav">
				<div class="row">
					<div class="col-sm-10 col-md-8 col-lg-8 mx-auto">
						<div class="card card-signin my-5 bg-dark">
							<div class="card-body">

								<h5 class="card-title text-center text-success"><?php echo $row['tipo']; ?></h5>
								<form class="form-signin">
									<p>
										<h6 class="text-success">Qualità massima: <?php echo $row['qualita'];?></h6>
										<h6 class="text-success">Numeri dispositivi massimi: <?php echo $row['numero_dispositivi'];?></h6>
										<h6 class="text-success">Prezzo: <?php echo $row['prezzo'] . " €";?></h6>
									</p>
									<br>
									<hr class="my-4">
									<button class="btn btn-lg btn-primary btn-block text-uppercase btn-success" type="submit">Abbonati!</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
		}
	}
	?>
	<br><br>
</body>
