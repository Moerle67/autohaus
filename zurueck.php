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
        <?php
          $sql =  'SELECT 
            fahrzeug.kennzeichen AS kennzeichen,
            kunde.name AS name,
            kunde.vorname AS vorname,
            mitarbeiter.name AS ma,
            auftrag.abgeholt AS abgeholt,
            auftrag.kmStart as kmstart, 
            auftrag.auftrag_id as id
            FROM auftrag 
            INNER JOIN fahrzeug 
            INNER JOIN kunde 
            INNER JOIN mitarbeiter 
            ON auftrag.Fahrzeug = fahrzeug.frz_id
            AND auftrag.kunde = kunde.kunde_id 
            AND auftrag.mitarbeiter = mitarbeiter.ma_id 
            WHERE zurueck IS NULL 
            ORDER BY abgeholt ASC  
          ';
          echo '<form method="POST" action="./auswertung.php">';
          foreach  ($conn->query($sql) as $row) {
            echo '<div class="row mt-7 gx-5">'; 
              echo '<div class="col mb-3 border bf-light p-3">';              
                echo $row["kennzeichen"];
              echo '</div>';
              echo '<div class="col mb-3 border bf-light p-3">';              
                echo $row["abgeholt"];
              echo '</div>';
              echo '<div class="col mb-3 border bf-light p-3">';              
                echo $row["name"].", ".$row["vorname"];
              echo '</div>';
              echo '<div class="col mb-3 border bf-light p-3">';              
                echo $row["ma"];
              echo '</div>';
              echo '<div class="col mb-3 border bf-light p-3">';              
                echo $row["kmstart"];
              echo '</div>';
              echo '<div class="col-2 mb-3 border bf-light p-3">';              
                echo '<input type="number" class="form-control" id="kmZurueck" value="';
                echo $row["kmstart"].'" min="';
                echo $row["kmstart"];
                echo '" name="km_';
                echo $row["id"];
                echo '" >';
              echo '</div>';
              echo '<div class="col mb-3 border bf-light p-3">';
                echo '<button type="submit" class="btn btn-success" name="button" value="';
                echo $row["id"];
                echo '">Rückgabe</button>';
              echo '</div>';
            echo '</div>';
          }
          echo '</form>';
        ?>
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
