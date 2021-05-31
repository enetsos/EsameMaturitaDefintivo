<?php
//get chat dell'utente
$emailMittente = $_GET["idu"];

$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
//definisco la query da eseguire
$sqlGetUtente = "SELECT messaggio.*,utente.email FROM messaggio,utente  GROUP BY messaggio.id_messaggio ORDER BY messaggio.id_messaggio";
$risUtente = mysqli_query($link, $sqlGetUtente);


foreach ($risUtente as $rigaGetUtente) {
    if (($_COOKIE['keepLogEmail'] == $rigaGetUtente['destinatario']) && ($rigaGetUtente["mittente"] == $emailMittente)) {
        $output = '
        <div class="row mittenteChat">
            <div class="col-md-2">
                <p class="form-check-label"><b>Messaggio</b></p>
                <p>' . $rigaGetUtente["testo"] . '</p>
            </div>    
        </div>';
        echo $output;
    }
    if (($rigaGetUtente["mittente"] == $_COOKIE['keepLogEmail']) && ($rigaGetUtente['destinatario'] == $emailMittente)) {

        if ($rigaGetUtente["tipologia"] == null && $rigaGetUtente["data_inizio"] == null && $rigaGetUtente["indirizzo_partenza"] == null && $rigaGetUtente["indirizzo_arrivo"] == null && $rigaGetUtente["telefono"] == null) {
            $output = '
            <div class="row destinatarioChat">
            <div class="col-md-10"></div>
                <div class="col-md-2">
                    <p class="form-check-label"><b>Messaggio</b></p>
                    <p>' . $rigaGetUtente["testo"] . '</p>
                </div>    
            </div>';
            echo $output;
        } else {
            $output = '
            <div class="destinatarioChat row">
                <div class="col-md-2">
                    <p class="form-check-label "><b>Tipologia</b></p>
                    <p>' . $rigaGetUtente["tipologia"] . '</p>
                </div>
                <div class="col-md-2">
                    <p class="form-check-label "><b>Date e Ora</b></p>
                    <p>' . $rigaGetUtente["data_inizio"] . '</p>
                </div>
                <div class="col-md-2">
                    <p class="form-check-label "><b>Indirizzo Partenza</b></p>
                    <p>' . $rigaGetUtente["indirizzo_partenza"] . '</p>
                </div>
                <div class="col-md-2">
                    <p class="form-check-label "><b>Indirizzo Arrivo</b></p>
                    <p>' . $rigaGetUtente["indirizzo_arrivo"] . '</p>
                </div>
                <div class="col-md-2">
                    <p class="form-check-label "><b>Telefono</b></p>
                    <p>' . $rigaGetUtente["telefono"] . '</p>
                </div>
                <div class="col-md-2">
                    <p class="form-check-label "><b>Messaggio</b></p>
                    <p>' . $rigaGetUtente["testo"] . '</p>
                </div>
            </div>';
            echo $output;
        }
    }
}

//inserimentoi effettuato corrttamente!!!
mysqli_close($link);
