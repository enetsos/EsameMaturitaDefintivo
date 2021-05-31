<?php
//aggiungo nuova corsa al dtb
$tipologia = $_POST["tipologia"];
$datetime = date("Y-m-d H:i:s", strtotime($_POST["date"]));
$indPartenza = $_POST["indPartenza"];
$indArrivo = $_POST["indArrivo"];
$emailCliente = $_POST["emailCliente"];
$telefono = $_POST["telefono"];
$prezzo = $_POST["prezzo"];
$targa = $_POST["targa"];

$emailMittente = $_COOKIE['keepLogEmail'];

$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");

$sqlGetIdUtente = "SELECT id_utente FROM utente WHERE email = '$emailCliente' GROUP BY id_utente";
$risGetIdUtente = mysqli_query($link,$sqlGetIdUtente);

foreach ($risGetIdUtente as $riga){
    $idUtente = $riga["id_utente"];
}

$sqlInsert = "INSERT INTO corsa (tipologia,data_inizio,indirizzo_partenza,indirizzo_arrivo,telefono,prezzo,targa,id_utente) 
VALUES ('" . $tipologia . "','" . $datetime . "','" . $indPartenza . "','" . $indArrivo . "','" . $telefono . "','" . $prezzo . "','" . $targa . "','" . $idUtente . "')";

echo $sqlInsert;
//eseguo la query che non restiutisce niente
mysqli_query($link, $sqlInsert) or die("non rieco ad eseguire la query");

//inserimentoi effettuato corrttamente!!!
mysqli_close($link);
