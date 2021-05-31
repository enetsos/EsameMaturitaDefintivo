<?php
//prende e stampa dal dtb le corse attive dell'utente
$emailUtente = $_COOKIE["keepLogEmail"];

$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
//definisco la query da eseguire

$sqlGetUtente = "SELECT corsa.*, utente.email FROM utente,corsa WHERE utente.id_utente = corsa.id_utente AND '$emailUtente' = utente.email ORDER BY corsa.data_inizio";
$risUtente = mysqli_query($link, $sqlGetUtente);


foreach ($risUtente as $rigaGetUtente) {

    $output = '
            <div class="row">
                <div class="col-md-3">
                    <p class="form-check-label "><b>Tipologia</b></p>
                    <p>' . $rigaGetUtente["tipologia"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Data e Ora</b></p>
                    <p>' . $rigaGetUtente["data_inizio"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Partenza</b></p>
                    <p>' . $rigaGetUtente["indirizzo_partenza"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Arrivo</b></p>
                    <p>' . $rigaGetUtente["indirizzo_arrivo"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Telefono Cliente</b></p>
                    <p>' . $rigaGetUtente["telefono"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Prezzo</b></p>
                    <p>' . $rigaGetUtente["prezzo"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Targa Macchina</b></p>
                    <p>' . $rigaGetUtente["targa"] . '</p>
                </div>
            </div>
            <hr id="getCorsaHrBox">';
    echo $output;
}

//inserimentoi effettuato corrttamente!!!
mysqli_close($link);
