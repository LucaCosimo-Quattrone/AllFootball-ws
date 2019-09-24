# AllFootball-ws
Questa repository contiene il client del progetto di piattaforme digitali e gestione del territorio.
L'applicazione è stata sviluppata e testata attraverso la piattaforma software WAMPServer, che mette a disposizione dell'utente un web server locale, un server DataBase MySQL e linguaggi di scripting (In questo caso PHP). La scelta di utilizzare WAMPServer è fortemente vincolata dalla necessità di avere un DataBase per la validazione degli utenti. <br><br>
Lo scopo del client è quello di simulare un sito web contenente le ultime informazioni sul calcio. Per la realizzazione sono state usate le seguenti tecnologie:


  - [PHP](https://www.php.net/): Utilizzato per realizzare gli script necessari a comunicare col ws.

  - [HTML](https://it.wikipedia.org/wiki/HTML): Utilizzato per l'impaginazione e la formattazione del sito web.

  - [CSS/Bootstrap](https://getbootstrap.com/): Per la gestione dei fogli di stile ho utilizzato il framework Bootstrap che permette all'utente, attraverso l'attribuzione di classi ai tag HTML, un gestione semplificata e migliorata dei CSS.

## Implementazione
La parte grafica e di formattazione sono gestite direttamente da Bootstrap per cui non verranno affrontate nella presentazione.
Nella repository troviamo invece il file index.php e altre due cartelle: pages e template. Ho strutturato il sito con un pattern MVC, in cui la navigazione avviene attraverso la pagina richiesta. L'index gestisce quindi, in base alla richiesta, quale pagina o azione mostrare.
Nella cartella pages troviamo i file che faranno parte del body del sito, per cui saranno gli elementi <em>DINAMICI</em> mentre nella cartella
template troviamo tutti gli elementi <em>STATICI</em>, ovvero l'head, l'header e il footer.<br>

### index.php

```php
$pagina_richiesta = isset($_GET['page']) ? basename((string) $_GET['page']) : $pagina_di_default;

$file_da_includere = "pages/" . $pagina_richiesta . ".php";

if(file_exists($file_da_includere) && !isset($_GET['formSquad']) && !isset($_GET['fixId']) && !isset($_GET['daily_n'])){
    include("template/head.php");
    include("template/header.php");
    include( $file_da_includere );
    include("template/footer.php");
}
```

Attraverso questa selezione l'index ottiene il nome della pagina da visualizzare, in alcuni casi, con richieste particolari, viene forzato l'include della pagina, quindi senza l'utilizzo della variabile '$file_da_includere'.
<br><br>
La parte più importante dell'index è però la funzione <em>getInfoByWs</em> perchè è basicamente il <em>core</em> della comunicazione con il ws.
```php
function getInfoByWs( $id, $request, $id2, $id3)
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
  ```
  Attraverso i parametri inseriti, non tutti sono richiesti (Ad esempio $id2, $id3), il ws riceve l'url designato con i corrispettivi parametri ed esegue la richiesta.

## Funzionamento
### home.php e login.php
  Home e login sono due pagine collegate, infatti in caso di login di un utente, la pagina home mostrerà una funzione in più riguardo le squadre. Ecco il codice semplificato:
  ```php
  if(isset($_SESSION['username']))
  {
    ...
  }
  ```
  Ecco quindi cosa si ottiene una volta entrati:
  ![home.php](/images/home.png)


  Per il login invece si effettua un check della password e dell'username col db, ottenendo ovviamente i dati in POST.

  ```php
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
  ```
### players.php

  Una volta selezionata la squadra su home.php e cliccato il bottone della form, otterremo la lista di tutti i giocatori di quella squadra identata in tabella.
  Una volta procurato l'id della squadra dalla form precedente, invio al ws la richiesta 'player', ottenendo come risposta la rosa della squadra della stagione corrente.
  ```php
  $team = $_GET['formSquad'];
  $data = getInfoByWs($team, "player", "", "");
  ```
  ![player.php](/images/player.png)

  In caso una informazione non sia riportata, nela tabella comparirà il simbolo '//'
  ```php
  if(!empty($data[$i]['position'])) echo $data[$i]['position']; else echo "//"; echo "<br><br>"; // Posizione
  ```  

### match.php

  Cliccando nella voce 'match' appunto ci verrà per prima cosa chiesto di selezionare la giornata da visualizzare, in seguito otterremo la lista delle 10 partite disputate(o ancora da disputare). Infatti se dalle informazioni mancherà il risultato finale il sito aggiungerà una voce alle info del match con scritto 'Da disputare'.
  ```php
  if(!isset($data[$i]['score']['fulltime']))
    echo "Da disputare";
  elseif($data[$i]['score']['extratime'] == "null")
    echo $data[$i]['score']['fulltime'];
  else
    echo $data[$i]['score']['extratime'];
  ```  
  Oltre alle varie informazioni sul match sarà presente un pulsante per visualizzare le formazioni iniziali delle due squadre, in caso la partita non sia stata mai disputata però, il pulsante non sarà presente

  <br>
  Ecco un esempio della pagina match:
  ![match.php](/images/match.png)

### lineup.php

  In questa pagina viene visualizzata la formazione delle due squadre di una partita.
  Accessibile tramite il relativo pulsante nella pagina match.php sfrutta l'impaginazione html concatenata con i tag di bootstrap per migliorare la visibilità del risultato.
  ![lineup.php](/images/lineup.png)
