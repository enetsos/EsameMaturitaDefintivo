
<?php
//apro connessione database
$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
//definisco la query da eseguire
$sqlSelect = "SELECT * FROM utente";
//echo $sql."<BR>";
//eseguo la query che restiuisce dei dati (un recordset $ris)
$risSelect = mysqli_query($link, $sqlSelect) or die("non rieco ad eseguire la query1");

//inizializzo variabili prese dal form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];

$email = $_COOKIE['keepLogEmail'];

//se nome e cognome sono vuote, nome e cognome sono uguali a quelle salvate nel dtb
if ($nome == "") {
    foreach ($risSelect as $riga) {
        if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
            $nome = $riga['nome'];
        }
    }
}

if ($cognome == "") {
    foreach ($risSelect as $riga) {
        if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
            $cognome = $riga['cognome'];
        }
    }
}

//sql update nome e cognome
$sqlUpdate = "UPDATE utente SET nome='" . $nome . "', cognome='" . $cognome . "' WHERE '$email' = utente.email";
//echo $nome . $cognome;
//echo $sqlUpdate;
//eseguo la query che restiuisce dei dati (un recordset $ris)
$risUpdate = mysqli_query($link, $sqlUpdate) or die($morta);

$f = $_FILES['avatarFoto']['type'];
$nomeFoto = $_FILES['avatarFoto']['name'];
$nome_tmp = $_FILES['avatarFoto']['tmp_name'];
//verifico il tipo di file, se si tratta di un'immagine (jpg o png)
if (($f == "image/jpeg") || ($f == "image/png")) {
    //Con move_uploaded_file il file verr� caricato dal client al server
    //nel percorso specificato come secondo parametro
    $urlFoto = "img/upload/" . rawurlencode($nomeFoto);
    move_uploaded_file($nome_tmp, $urlFoto);
    //inserisco url e descrizione nel database
    if (mysqli_connect_errno()) {
        echo "errore nella connessione al database!!!";
        exit();
    }
    //sql update foto profilo
    $sqlInsert = "UPDATE utente SET foto_profilo ='" . $urlFoto . "' WHERE '$email' = utente.email";
    $risInsert = mysqli_query($link, $sqlInsert) or die("non riesco ad eseguire la query insert");
}
header("Refresh:0; url=areaPersonale.php");
