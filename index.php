<?php
include("script/connection.php");
session_start();

function getInfoByWs($id, $request, $id2, $id3)
{
  if($request == "general" || $request == "squad")
    $url = "https://piattaformedigitali-ws.herokuapp.com/index.php?request=". $request ."&league-id=". $id;
  else if($request == "player")
    $url = "https://piattaformedigitali-ws.herokuapp.com/index.php?request=player&team_id=". $id;
  else if($request == "lineup")
  {
    $homeTeam = urlencode($id2);
    $awayTeam = urlencode($id3);
    $url = "https://piattaformedigitali-ws.herokuapp.com/index.php?request=lineup&fix_id=". $id ."&home-team=". $homeTeam ."&away-team=". $awayTeam;
  }
  else
    $url = "https://piattaformedigitali-ws.herokuapp.com/index.php?request=roundfix&league-id=". $id ."&round=". $id2;

  $pagina = file_get_contents($url);
  $data = json_decode($pagina, true);
  return $data;
}

/*
Lega di default
*/
$lega = 524;

/*
Setto la pagina di default
*/
$pagina_di_default = 'home';

/*
Setto la pagina 404 (not found)
*/
$pagina_404 = 'pages/404.php';

/*
Verifico il valore indicato dall'utente
*/
$pagina_richiesta = isset($_GET['page']) ? basename((string) $_GET['page']) : $pagina_di_default;

/*
Compongo il percorso da raggiungere
*/
$file_da_includere = "pages/" . $pagina_richiesta . ".php";

if(file_exists($file_da_includere) && !isset($_GET['formSquad']) && !isset($_GET['fixId']) && !isset($_GET['daily_n'])){
    include("template/head.php");
    include("template/header.php");
    include( $file_da_includere );
    include("template/footer.php");
}
else if (file_exists($file_da_includere) && isset($_GET['formSquad']))
{
    $search_team_id = $_GET['formSquad'];
    include("template/head.php");
    include("template/header.php");
    include("pages/players.php");
    include("template/footer.php");
}
else if (file_exists($file_da_includere) && isset($_GET['fixId']))
{
  $search_fix_id = $_GET['fixId'];
  include("template/head.php");
  include("template/header.php");
  include("pages/lineup.php");
  include("template/footer.php");
}
else if (file_exists($file_da_includere) && isset($_GET['daily_n']))
{
  $search_daily_id = $_GET['daily_n'];
  include("template/head.php");
  include("template/header.php");
  include("pages/match.php");
  include("template/footer.php");
}
else
{
	  include("template/head.php");
    include("template/header.php");
    include( $pagina_404 );
    include("template/footer.php");
}

?>
