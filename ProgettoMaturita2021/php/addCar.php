<?php

//aggiungo nuova auto al dtb


$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");

$targa = $_POST["targa"];

$marca = $_POST["marca"];

$modello = $_POST["modello"];

$disponibile = $_POST["disponibile"];

$sql = "INSERT INTO auto (targa,marca,modello,disponibilita) VALUES ('" . $targa . "','" . $marca . "','" . $modello . "','" . $disponibile . "')";

mysqli_query($link, $sql) or die("non rieco ad eseguire la query");
//inserimentoi effettuato corrttamente!!!
mysqli_close($link);
echo $sql;
