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
            <div class="row">
              <div class="col-2">
                  <?php
                echo '<select class="form-select" aria-label="Auswahl Hersteller" name="selHersteller">';
                if ($_SERVER["REQUEST_METHOD"] == "GET" || (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["btn1"] == "return"))) {
                      $sql =  'SELECT hersteller_id AS id,hersteller.Bezeichnung as Bezeichnung FROM modell 
                      INNER JOIN fahrzeug 
                      INNER JOIN hersteller 
                      ON fahrzeug.verfügbar = 1 AND 
                      fahrzeug.modell = modell.modell_id AND 
                      modell.hersteller = hersteller.hersteller_id 
                      GROUP BY hersteller.Bezeichnung
                      ORDER BY hersteller.Bezeichnung';
                      foreach  ($conn->query($sql) as $row) {
                        echo '<option value="'.$row['id'].'">'.$row['Bezeichnung'].'</option>';
                      } ?>
                 </select>
              </div>    
              <div class="col-3">
                <button type="submit" class="btn btn-primary" name="btn1" value="btnHersteller">Hersteller festlegen</button>
              </div>
            <?php 
                } else if (($_POST["btn1"] == "btnHersteller")){
                  echo '<select class="form-select" aria-label="Auswahl Hersteller" name="selHersteller">';
                  $sql =  'SELECT * FROM hersteller WHERE hersteller_id='.$_POST['selHersteller'];
                  $result = $conn->query($sql)->fetch();
                  echo '<option value="'.$result['hersteller_id'].'">'.$result['Bezeichnung'].'</option>';
                  echo '<\select>';
                    ?>
              <?php
              if ($_SERVER["REQUEST_METHOD"] != "GET" && $_POST["btn1"]=="btnHerstellung") {
                // Modell einlesen
                $hersteller_id = $_POST["selHersteller"];
                echo '<div class="col-2">';
                echo '<select class="form-select"  name="selModell">';
                $sql =  "SELECT * FROM modell 
                INNER JOIN fahrzeug 
                INNER JOIN hersteller 
                ON fahrzeug.verfügbar = 1 AND fahrzeug.modell = modell.modell_id 
                AND modell.hersteller = hersteller.hersteller_id 
                AND modell.hersteller = '$hersteller_id'
                GROUP BY modell.bezeichnung;";
                foreach  ($conn->query($sql) as $row) {
                  echo '<option value="'.$row['modell_id'].'">'.$row['bezeichnung'].'</option>';
                }
                echo '</select>';
                echo '</div>';
              } 
            }  
              ?>
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
