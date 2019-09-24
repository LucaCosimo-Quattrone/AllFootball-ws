<body class="bg-secondary">
  <!-- Page Content -->
	<div class="container">
		<div class="jumbotron my-4 jumbotron-fkuid bg-dark">
			<div class="row text-success">

				<div class="col-sm-3">
					 Nome intero
				</div>

				<div class="col-sm-2">
					 Posizione
				</div>

				<div class="col-sm-1">
					 Età
				</div>

				<div class="col-sm-2">
					 Nazionalita
				</div>

				<div class="col-sm-1">
					 Altezza
				</div>

			</div>
			<br><br>
			<?php
			$team = $_GET['formSquad'];
			$data = getInfoByWs($team, "player", "", ""); // league id 524 è l'id della premier league 2019/2020

			if($data["status"] >= 200
							&& $data["status"] < 300)
			{

					$data = $data["data"];

					for ($i = 0;
							 $i < count($data);
							 $i++)
					{
						if(!empty($data[$i]['player_name']))
						{
							 ?>
						<div class="row text-success">
							<div class="col-sm-3">
									<?php echo $data[$i]['player_name']; // Nome intero ?>
							</div>

							<div class="col-sm-2">
									<?php if(!empty($data[$i]['position'])) echo $data[$i]['position']; else echo "//"; echo "<br><br>"; // Posizione ?>
							</div>

							<div class="col-sm-1">
									<?php if(!empty($data[$i]['age'])) echo $data[$i]['age']; else echo "//"; echo "<br><br>";// Età ?>
							</div>

							<div class="col-sm-2">
									<?php if(!empty($data[$i]['nationality'])) echo $data[$i]['nationality']; else echo "//"; echo "<br><br>";// Nazionalita ?>
							</div>

							<div class="col-sm-1">
									<?php if(!empty($data[$i]['height'])) echo $data[$i]['height']; else echo "//"; echo "<br><br>"; // Altezza ?>
							</div>

						</div>

				<?php
					}
				}
			}
				?>
			</div>
		</div>
	</div>

</body>
