<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>&copy; Moerlisoft</title>
  </head>
  <body>
    <div class="container">
      <?php
          include "dat/dat1.php";
      ?>
      <h1>Autohaus &copy; Moerlisoft</h1>
      <div class="row">         
        <div class="col-md-10">
          <form method="POST">          
            <div class="row mt-7">
              <!-- Mitarbeiter -->
              <div class="col-md-6 mb-3">
                <label for="inputMitarbeiter" class="form-label">Mitarbeiter</label>
                <select class="form-select"  name="selMa" id="inputMitarbeiter">
                <?php
                  // var_dump($_POST);
                  $sql =  'SELECT * FROM mitarbeiter';
                  foreach  ($conn->query($sql) as $row) {
                    echo '<option value="'.$row['ma_id'].'"';
                    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['selMa']==$row['ma_id'])) {
                      echo ' selected'; 
                    }
                    echo '>'.$row['name'].', '.$row['vorname'].'</option>';
                  }
                ?>
                </select>
              </div>
              <!-- Kunde -->
              <div class="col-md-6 mb-3">
              <label for="inputKunde" class="form-label">Kunde</label>
                <select class="form-select"  name="selKunde" id="inputKunde">
                <?php
                  var_dump($_POST);
                  $sql =  'SELECT * FROM kunde';
                  foreach  ($conn->query($sql) as $row) {
                    echo '<option value="'.$row['kunde_id'].'"';
                    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['selKunde']==$row['kunde_id'])) {
                      echo ' selected'; 
                    }
                    echo '>'.$row['name'].', '.$row['vorname'].'</option>';
                  }
                ?>
                </select>
              </div>
            </div>
            <!-- Fahrzeugauswahl -->
            <div class="row">
                <?php
// Auswahl Fahrzeug
                // Erste Runde Hersteller auswählen
                // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //   var_dump($_POST);
                //   var_dump($_SERVER);
                // }
                if ($_SERVER["REQUEST_METHOD"] == "GET" || (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["btn1"] == "return"))) {
                  echo '<div class="col-2 mb-3">';
                    $sql =  'SELECT hersteller_id AS id,hersteller.Bezeichnung as Bezeichnung FROM modell 
                        INNER JOIN fahrzeug 
                        INNER JOIN hersteller 
                        ON fahrzeug.verfügbar = 1 AND 
                        fahrzeug.modell = modell.modell_id AND 
                        modell.hersteller = hersteller.hersteller_id 
                        GROUP BY hersteller.Bezeichnung
                        ORDER BY hersteller.Bezeichnung';
                    $result = $conn->query($sql)->fetchAll();
                    // Anzahl gefundener Datensätze
                    if (count($result)>1) {
                      // Liste generieren 
                      echo '<label for="selHersteller" class="form-label">Kunde</label>';
                      echo '<select class="form-select" name="selHersteller" id="selHersteller">';
                      foreach  ($result as $row) {
                        echo '<option value="'.$row['id'].'">'.$row['Bezeichnung'].'</option>';
                      }
                    echo '</select>';
                    } else if (count($result)==1) {
                      // ein Datensatz --> Textfeld reicht  
                      echo '<label for="txtHersteller" class="form-label">Kunde</label>';
                      echo '<input type="text" id="txtHersteller" readonly class="form-control" value="'.$result[0]['Bezeichnung'].'">';
                      echo '<input type="hidden" name="selHersteller" value="'.$result[0]['id'].'">';
                    } else
                      // nichts --> Fehlermeldung
                      echo '<input type="text" readonly class="form-control" value="Kein Kfz verfügbar!">';
                  echo '</div>'; 
                  if (count($result)>0) {
                    // Weiter nur, wenn Fahrzeug verfügbar ist   
                    echo '<div class="col-3">';
                      echo '<label for="btnHersteller" class="form-label">Bestätigen</label><br />';
                      echo '<button type="submit" class="btn btn-primary" id="btnHersteller" name="btn1" value="btnHersteller">Hersteller festlegen</button>';
                    echo '</div>';
                  }
                } else if (($_POST["btn1"] == "btnHersteller")){
// Zweite Runde Auswahl Model
                  echo '<div class="col-2 mb-3">';
                    // Erstes Textfeld: Nur gewählter Hersteller
                    $sql =  'SELECT * FROM hersteller WHERE hersteller_id='.$_POST['selHersteller'];
                    $result = $conn->query($sql)->fetch();
                    echo '<label for="txtlHersteller" class="form-label">Hersteller</label>';
                    echo '<input type="text" readonly id="txtHersteller" class="form-control" name="txtHersteller" value="'.$result['Bezeichnung'].'">';
                    echo '<input type="hidden" name="txtHerstellerId" value="'.$result['hersteller_id'].'">';
                  echo '</div>';    
                  // Modell einlesen
                  $hersteller_id = $_POST["selHersteller"];
                  echo '<div class="col-2">';
                    $sql =  "SELECT * FROM modell 
                      INNER JOIN fahrzeug 
                      INNER JOIN hersteller 
                      ON fahrzeug.verfügbar = 1 
                      AND fahrzeug.modell = modell.modell_id 
                      AND modell.hersteller = hersteller.hersteller_id 
                      AND modell.hersteller = '$hersteller_id'
                      GROUP BY modell.bezeichnung;";
                  $result = $conn->query($sql)->fetchAll();
                  if (count($result)>1) {
                    echo '<label for="selModel" class="form-label">Modell</label>';
                    echo '<select class="form-select"  name="selModell" id="selModell">';
                    foreach  ($conn->query($sql) as $row) {
                      echo '<option value="'.$row['modell_id'].'">'.$row['bezeichnung'].'</option>';
                    }
                    echo '</select>';
                  } else {
                    // ein Datensatz --> Textfeld reicht  
                    echo '<label for="selModel" class="form-label">Modell</label>';
                    echo '<input type="text" readonly id="selModel" class="form-control" value="'.$result[0]['bezeichnung'].'">';
                    echo '<input type="hidden" name="selModell" value="'.$result[0]['modell_id'].'">';
                  }
                  echo '</div>';
                  echo '<div class="col-3">';
                  echo '<label for="btnModel" class="form-label">Bestätigen</label><br />';
                  echo '<button type="submit" id="btnModell" class="btn btn-primary" name="btn1" value="btnModell">Modell festlegen</button>';
                  echo '</div>';
                } else if (($_POST["btn1"] == "btnModell")){
// Auswahl Fahrzeug
                  // Hersteller
                  echo '<div class="col-2 mb-3">'; 
                    echo '<label for="txtHersteller" class="form-label">Hersteller</label>';
                    echo '<input type="text" readonly id="txtHersteller" class="form-control" name="txtHersteller" value="'.$_POST['txtHersteller'].'">';
                    echo '<input type="hidden" name="txtHerstellerId" value="'.$_POST['txtHerstellerId'].'">';
                  echo '</div>';  
                  echo '<div class="col-2">';
                    // Zweites Textfeld: Nur gewähltes Modell
                    $sql =  'SELECT * FROM modell WHERE modell_id='.$_POST['selModell'];
                    $result = $conn->query($sql)->fetch();
                    echo '<label for="txtModell" class="form-label">Modell</label>';
                    echo '<input type="text" id="txtModell" readonly class="form-control" name="txtModell" value="'.$result['bezeichnung'].'">';
                    echo '<input type="hidden" name="txtModellId" value="'.$result['modell_id'].'">';
                  echo '</div>';  
                  echo '<div class="col-2">';
                  // Liste Fahrzeuge (Kennzeichen)
                  $sql =  'SELECT * FROM fahrzeug WHERE modell='.$_POST['selModell'].' AND verfügbar=1;' ;
                  $result = $conn->query($sql)->fetchAll();
                  if (count($result)>1) {
                    echo '<label for="selKfz" class="form-label">Fahrzeug</label>';
                    echo '<select class="form-select" id="selKfz" name="selFahrzeug">';
                    foreach  ($conn->query($sql) as $row) {
                      echo '<option value="'.$row['frz_id'].'">'.$row['kennzeichen'].'</option>';
                    }
                    echo '</select>';
                  } else {
                    // Nur ein Fahrzeug
                    echo '<label for="txtKfz" class="form-label">Fahrzeug</label>';
                    echo '<input type="text" id="txtKfz" readonly class="form-control" value="'.$result[0]['kennzeichen'].'">';
                    echo '<input type="hidden" name="selKfz" value="'.$result[0]['frz_id'].'">';
                 
                  }
                  echo '</div>';
                  echo '<div class="col-2 sb-3">';
                    echo '<label for="txtKm" class="form-input mb-2">akt. km</label>';
                    echo '<input type="number" class="form-control" id="txtKm" name="txtKm">';
                  echo '</div>';
                  echo '<div class="col-2 sb-3">';
                    echo '<label for="btnKfz" class="form-label">Abschluss</label><br />';
                    echo '<button type="submit" id="btnKfz" class="btn btn-success" name="btn1" value="btnAbschluss">Vermieten</button>';
                  echo '</div>';
                } else if (($_POST["btn1"] == "btnAbschluss")){
                    $kunde = $_POST['selKunde'];
                    $mitarbeiter = $_POST['selMa'];
                    $fahrzeug = $_POST["selKfz"];
                    $kmStart = $_POST["txtKm"];
                    date_default_timezone_set("Europe/Berlin");
                    $phptime=time();
                    $datStart = date ('Y-m-d H:i:s', $phptime);

                    // Auftrag in die Datenbank schreiben
                    $sql = "INSERT INTO auftrag (kunde, mitarbeiter, Fahrzeug, abgeholt, kmStart)
                      VALUES ('$kunde', '$mitarbeiter', '$fahrzeug', '$datStart', '$kmStart')";
                    if ($conn->query($sql) == True) {
                      echo "Auftrag erfolgreich";
                    } else {
                      echo "Error: " . $sql . "<br>" . $conn->error;
                    }                    
                    // Fahrzeug als nicht verfügbar markieren
                    $sql = "UPDATE fahrzeug SET verfügbar=False WHERE frz_id=$fahrzeug;";
                    if ($conn->query($sql) == True) {
                      echo "Fahrzeug erfolgreich";
                    } else {
                      echo "Error: " . $sql . "<br>" . $conn->error;
                    }                    
                    // header("Location: https://www.codegrepper.com/my-redirect-page.php");
                    // die();
                }
                ?>
                <div class="col-2 ">     
                  <br />                             
                  <button type="submit" class="btn btn-danger float-end mt-2" name="btn1" value="return" id="btnReturn">Abbruch</button>
                </div>
            </div>
          </form>
        </div>        
          <?php
              include "seite.html"
          ?>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
  </body>
</html>
