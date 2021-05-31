<?php
//stampo auto del dtb
$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
//definisco la query da eseguire
$sqlGetUtente = "SELECT * FROM auto ORDER BY auto.marca";
$risUtente = mysqli_query($link, $sqlGetUtente);


foreach ($risUtente as $rigaGetUtente) {

    $output = '
            <div class="row">
                <div class="col-md-3">
                    <p class="form-check-label "><b>Targa</b></p>
                    <p>' . $rigaGetUtente["targa"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Marca</b></p>
                    <p>' . $rigaGetUtente["marca"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Modello</b></p>
                    <p>' . $rigaGetUtente["modello"] . '</p>
                </div>
                <div class="col-md-3">
                    <p class="form-check-label "><b>Disponibilità</b></p>
                    <p>' . $rigaGetUtente["disponibilita"] . '</p>
                </div>
            </div>';
    echo $output;
}

//inserimentoi effettuato corrttamente!!!
mysqli_close($link);
