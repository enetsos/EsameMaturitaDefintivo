<?php
//inserisce i messaggi nel dtb
$link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database") or die ("no link");

$inputChat =  mysqli_real_escape_string($link, $_GET['message']);
$emailDestinatario = $_GET["dest"];

$emailMittente = $_COOKIE['keepLogEmail'];

$sqlInsertMessage = "INSERT INTO messaggio (testo, destinatario, mittente) VALUES ('" . $inputChat . "','" . $emailDestinatario . "','" . $emailMittente . "')" or die("no sql");
echo $emailDestinatario;
mysqli_query($link, $sqlInsertMessage);


//inserimentoi effettuato corrttamente!!!
mysqli_close($link);
