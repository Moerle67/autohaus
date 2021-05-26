<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Auswertung</title>
    <style>
        th, td {
            border: 1px solid gray;
        }
        table {
            border: 1px solid black;
        }
    </style>
  </head>
  <body>
    <div class="container">
    <div class="row">
    <div class="col-md-10">
    <h1>Abschluss</h1>
    <?php
        include "dat/dat1.php";
        $id = $_POST["button"];
        $km = $_POST["km_$id"];
        $sql =  "SELECT 
        fahrzeug.kennzeichen AS kennzeichen,
        fahrzeug.frz_id AS frz_id,
        kunde.name AS name,
        kunde.vorname AS vorname,
        mitarbeiter.name AS ma,
        auftrag.abgeholt AS abgeholt,
        auftrag.kmStart AS kmstart, 
        auftrag.auftrag_id AS id,
        preisgruppe.stunde AS prstunde,
        preisgruppe.km AS prkm,
        preisgruppe.pauschal AS prpauschal,
        preisgruppe.bezeichnung AS prname
        FROM auftrag 
        INNER JOIN fahrzeug 
        INNER JOIN kunde 
        INNER JOIN mitarbeiter
        INNER JOIN preisgruppe 
        ON auftrag.Fahrzeug = fahrzeug.frz_id
        AND auftrag.kunde = kunde.kunde_id 
        AND auftrag.mitarbeiter = mitarbeiter.ma_id 
        AND fahrzeug.preisgruppe = preisgruppe.preisgr_id 
        WHERE auftrag_id = $id   
      ";
        $result = $conn->query($sql)->fetch();
        echo "<table>";
        echo "<tr><td>Fahrzeug</td><td>".$result['kennzeichen']."</td></tr>";
        echo "<tr><td>Kunde</td><td>".$result['name'].", ".$result['vorname']."</td></tr>";
        echo "<tr><td>Verleih-Datum</td><td>".$result['abgeholt']."</td></tr>";
        echo "<tr><td>Km-Start</td><td>".$result['kmstart']."</td></tr>";
        echo "<tr><td>Km-Rückgabe</td><td>".$km."</td></tr>";
        echo "<tr><td>Entfernung</td><td>".$km-$result['kmstart']."</td></tr>";
        $zeitstart = strtotime($result["abgeholt"]);
        $zeitbis = time();
        $zeitbis_sql= date ('Y-m-d H:i:s', $zeitbis);
        $zeitdiff = $zeitbis-$zeitstart;
        $tage = intdiv($zeitdiff,3600*24);
        $reststunden = $zeitdiff - $tage*3600*24;
        $stunden = intdiv($reststunden, 3600);
        $preisStunde = ($tage*24+$stunden)*intval($result['prstunde']);
        $preiskm =  ($km-$result['kmstart'])*$result['prkm'];
        $preispauschal = intval($result['prpauschal']);
        $preis = ($preisStunde+$preiskm+$preispauschal)/100;
        echo "<tr><td>Dauer</td><td>".$tage." Tage und ".$stunden." Stunden </td></tr>";
        echo "<tr><td>Preisgruppe: ".$result['prname']."</td><td>Preis: ".$preis." €</td></tr>";
        echo "</table>";
        $frz_id = $result['frz_id'];
        $sql = "UPDATE fahrzeug SET verfügbar=True WHERE frz_id=$frz_id;";
        if ($conn->query($sql) == True) {
            echo "<p>Fahrzeug erfolgreich freigegeben</p>";
        } else {
            echo "Error bei Fahrzeugfreigabe: " . $sql . "<br>" . $conn->error;
        }                    
        $sql = "UPDATE auftrag SET kmEnde=$km, zurueck='$zeitbis_sql' WHERE auftrag_id = $id";
        if ($conn->query($sql) == True) {
            echo "<p>Auftrag erfolgreich abgeschlossen</p>";
        } else {
            echo "Error bei Auftragsabschluss: " . $sql . "<br>" . $conn->error;
        }                    

    ?>
    </div>
        <?php
            include "seite.html"
        ?>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
