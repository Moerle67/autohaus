-- Abfrage freies Fahrzeug --> Hersteller
SELECT hersteller.Bezeichnung as hersteller FROM modell 
INNER JOIN fahrzeug 
INNER JOIN hersteller 
ON fahrzeug.verfügbar = 1 AND 
fahrzeug.modell = modell.modell_id AND 
modell.hersteller = hersteller.hersteller_id AND
fahrzeug.frz_id IS NOT NULL
GROUP BY hersteller.Bezeichnung
ORDER BY hersteller.Bezeichnung
-- Abfrage Freies Fahrzeug, Hersteller bekannt --> Modell
SELECT modell.bezeichnung as Modell FROM `modell` 
INNER JOIN fahrzeug 
INNER JOIN hersteller 
ON fahrzeug.verfügbar = 1 AND fahrzeug.modell = modell.modell_id 
AND modell.hersteller = hersteller.hersteller_id 
AND modell.hersteller = '2' AND 
fahrzeug.frz_id IS NOT NULL 
GROUP BY modell.bezeichnung