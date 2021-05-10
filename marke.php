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
        <div class="col-10">
          <form>          
            <div class="form-row">
              <div class="col">
                <select class="form-select" aria-label="Auswahl Hersteller">
                <?php
                  $sql =  'SELECT hersteller_id as id, Bezeichnung FROM hersteller ORDER BY bezeichnung';
                  foreach  ($conn->query($sql) as $row) {
                    echo '<option value="'.$row['id'].'">'.$row['Bezeichnung'].'</option>';
                  }
                ?>
                </select>
              </div>
              <div class="col">
                <button type="submit" class="btn btn-primary">Modell bestimmen</button>
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
