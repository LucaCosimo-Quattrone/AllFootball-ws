<body class="bg-secondary">
	<br><br>
	<div class="container">
    <?php


				if(isset($_GET['daily_n']))
				{
					$round = $_GET['daily_n'];
					$data = getInfoByWs($lega, "roundfix", $round, ""); // league id 524 è l'id della premier league 2019/2020

					if($data["status"] >= 200
						&& $data["status"] < 300)
						{

							$data = $data["data"];

					for ($i = 0;
							 $i < 10;
						   $i++)
					{
			?>
							<div class="jumbotron bg-dark">
							    <div class="row">
							      <div class="col-md-4 text-left">
											<div class="h-100 bg-dark">
												<img class="card-img-top img-fluid" src="<?php echo $data[$i]['homeTeam']['logo']; ?>" alt="Responsive image">
												<div class="card-body bg-black">
													<h4 class="card-title text-success"><?php echo $data[$i]['homeTeam']['team_name']; ?></h4>
												</div>
											</div>

							      </div>
							      <div class="col-md-4 text-center text-success">
											<div class="justify-content-start">
												<p> <?php echo $data[$i]['event_date']; ?> <br><br> </p>
											</div>
											<div class="justify-content-center">
												<p> Risultato finale: <br><br><br>  <h2>
													<?php
													if(!isset($data[$i]['score']['fulltime']))
														echo "Da disputare";
													elseif($data[$i]['score']['extratime'] == "null")
														echo $data[$i]['score']['fulltime'];
													else
														echo $data[$i]['score']['extratime'];
														?>
													</h2> </p>
											</div>
											<div class="justify-content-end">
												<p><br><br> <?php echo $data[$i]['round']; ?><br><br><br><br>

													<?php
													if(isset($data[$i]['score']['fulltime']))
													{
													?>
														<a href="index.php?page=lineup&fix_id=<?php echo $data[$i]['fixture_id']; ?>&home_team=<?php echo $data[$i]['homeTeam']['team_name']; ?>&away_team=<?php echo $data[$i]['awayTeam']['team_name']; ?>" class="btn btn-success btn-lg">Guarda le formazioni!</a>
													<?php
													}
													?>

												</p>
											</div>

							      </div>
										<div class="col-md-4 text-right text-success">


										<div class="h-100 bg-dark">
											<img class="card-img-top img-fluid" src="<?php echo $data[$i]['awayTeam']['logo']; ?>" alt="Responsive image">
											<div class="card-body bg-black">
												<h4 class="card-title text-success"><?php echo $data[$i]['awayTeam']['team_name']; ?></h4>
											</div>
										</div>

										</div>
							    </div>
								</div>

			<?php

			}
		}
	}
	else
	{

		$data = getInfoByWs($lega, "general", "", ""); // league id 524 è l'id della premier league 2019/2020

		if($data["status"] >= 200
			&& $data["status"] < 300)
			{

				$data = $data["data"];
		?>

		<div class="jumbotron my-4 bg-dark">
			<h2 class="display-4 text-success">Ecco a te le informazioni sui match!</h2><br><br>
			<label class="my-1 mr-2 text-success" for="daily_n">Scegli una giornata:</label>
			<form class="form-inline" method="get" action="index.php">
				<select class="custom-select my-1 mr-sm-2" name="daily_n">
					<option selected>Scegli...</option>
					<?php
						for ($i = 0;
		 						 $i < 40;
		 						 $i++)
						{
							?>
								<option value="<?php echo $i+1; ?>"> Giornata: <?php echo $i+1; ?> </option>";
							<?php
						}
					?>
				</select>
				<hr>
				<br><br>
				<div class="align-bottom">
					<button class="btn btn-success my-3 my-sm-1" type="submit">Cerca</button>
				</div>

			</form>
		</div>

		<?php

		}

	}
?>

	</div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<?php //$mysqli->close(); ?>
