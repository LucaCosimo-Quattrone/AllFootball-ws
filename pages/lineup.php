<body class="bg-secondary">

	<div class="container-fluid">
		<div class="jumbotron my-4 jumbotron bg-dark">
			<?php
			$id = $_GET['fix_id'];
			$data = getInfoByWs($id, "lineup", $_GET['home_team'], $_GET['away_team']); // league id 524 è l'id della premier league 2019/2020

			if($data["status"] >= 200
							&& $data["status"] < 300)
			{

					$data = $data["data"];
					?>

					<div class="row text-success">

						<div class="col-sm-5 text-center">
							 <h3><?php echo $_GET['home_team']; ?></h3><br><br>
							 Formazione: <?php echo $data['homeTeam']['formation']; ?>
						</div>

						<div class="col-sm-2">
						</div>

						<div class="col-sm-5 text-center">
							 <h3><?php echo $_GET['away_team']; ?></h3><br><br>
							 Formazione: <?php echo $data['awayTeam']['formation']; ?>
						</div>

					</div>
					<br><br>

					<div class="row text-success">


						<div class="col-sm-3">
							 Nome giocatore
						</div>

						<div class="col-sm-1">
							Numero
						</div>

						<div class="col-sm-1">
							Posizione
						</div>


						<div class="col-sm-2">
						</div>


						<div class="col-sm-3">
							 Nome giocatore
						</div>

						<div class="col-sm-1">
							Numero
						</div>

						<div class="col-sm-1">
							Posizione
						</div>

					</div>
					<br><br>


					<?php

					for ($i = 0;
							 $i < 11;
							 $i++)
					{
						if((!empty($data['homeTeam']['startXI'][$i]['player']) && !empty($data['homeTeam']['startXI'][$i]['number']) && !empty($data['homeTeam']['startXI'][$i]['pos']))
						 		&& (!empty($data['awayTeam']['startXI'][$i]['player']) && !empty($data['awayTeam']['startXI'][$i]['number']) && !empty($data['awayTeam']['startXI'][$i]['pos'])))
								{
							 ?>
						<div class="row text-success">


							<div class="col-sm-3">
									<?php echo $data['homeTeam']['startXI'][$i]['player']; ?>
							</div>
							<div class="col-sm-1">
									<?php echo $data['homeTeam']['startXI'][$i]['number']; ?>
							</div>
							<div class="col-sm-1">
									<?php echo $data['homeTeam']['startXI'][$i]['pos']; ?>
							</div>

							<div class="col-sm-2">
							</div>

							<div class="col-sm-3">
									<?php echo $data['awayTeam']['startXI'][$i]['player']; ?>
							</div>
							<div class="col-sm-1">
									<?php echo $data['awayTeam']['startXI'][$i]['number']; ?>
							</div>
							<div class="col-sm-1">
									<?php echo $data['awayTeam']['startXI'][$i]['pos']; ?>
							</div>

						</div>
						<hr>
						<br>

				<?php
					}
				}
			}
				?>
			</div>
		</div>
	</div>

</body>
