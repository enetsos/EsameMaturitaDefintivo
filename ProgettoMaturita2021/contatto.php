<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <link rel="stylesheet" href="css.css">
    <!--includo lo stile css-->

</head>

<body>

    <!--menu-->
    <?php
    include("src/menu.php");
    if (isset($_COOKIE['keepLogEmail']) && isset($_COOKIE["KeepLogRole"])) {
        if (!isset($_POST['submit'])) { ?>
            <br><br><br><br>

            <form action="contatto.php" method="post" class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">

                        <span class="Logintext" for="start"><b>Tipologia:</b></span><br>
                        <select class="form-select" aria-label="Default select example" name="tipologia">
                            <option value="Standard">Standard</option>
                            <option value="Van">Van</option>
                            <option value="Luxury">Luxury</option>
                        </select><br>

                        <span class="Logintext" for="date"><b>Data e Ora di Partenza:</b></span><br>
                        <input type="datetime-local" name="date" class="Logininput" MAXsize=80><br><br>

                        <span class="Logintext" for="start"><b>Partenza:</b></span><br>
                        <div id="startAutosuggestion"><input type="text" name="start" class="Logininput" id="start" MAXsize=80 onchange="loadRoutes()"></div><br>

                        <span class="Logintext" for="end"><b>Arrivo:</b></span><br>
                        <div id="endAutosuggestion"><input type="text" name="end" class="Logininput" id="end" MAXsize=80 onchange="loadRoutes()"></div><br>

                        <span class="Logintext" for="telephone"><b>Numero di Telefono:</b></span><br>
                        <input type="tel" name="telephone" class="Logininput" MAXsize=80 pattern="[0-9]{10}"><br><br>

                        <span class="Logintext" for="messaggio"><b>Messaggio:</b></span><br>
                        <textarea class="Logininput" name="messaggio" rows="4" cols="40"></textarea>

                        <br><br>
                        <input type="submit" value="Invia" name="submit" class="btnContact" />ì
                    </div>
                    <!--mappa bing-->
                    <div class="col-md-4 map" id="map"></div>
                </div>
            </form>


            <!--piè di pagina-->
        <?php
        } else {
            //prendo i dati dal form
            $tipologia = $_POST["tipologia"];
            $datetime = date("Y-m-d H:i:s", strtotime($_POST["date"]));
            $indPartenza = $_POST["start"];
            $indArrivo = $_POST["end"];
            $telefono = $_POST["telephone"];
            $testo = $_POST["messaggio"];
            $destinatario = "jetw.ncc@gmail.com";

            $emailMittente = $_COOKIE['keepLogEmail'];

            //connessione al database
            $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
            
            //inserisco i dati nella tabella messaggio
            $sqlInsert = "INSERT INTO messaggio (tipologia,data_inizio,indirizzo_partenza,indirizzo_arrivo,telefono,testo,destinatario,mittente) VALUES ('" . $tipologia . "','" . $datetime . "','" . $indPartenza . "','" . $indArrivo . "','" . $telefono . "','" . $testo . "','" . $destinatario . "','" . $emailMittente . "')";

            echo $sqlInsert;
            //eseguo la query che non restiutisce niente
            mysqli_query($link, $sqlInsert) or die("non rieco ad eseguire la query");

            //inserimentoi effettuato corrttamente!!!
            mysqli_close($link);
            header("Location:home.php");
        }
    } else { ?>
        <br><br><br><br>
        <div class="container-fluid">
            <div class="row text-center">
                <p class="col-md-12 topSubTitle" style="color: red;">Accedi o Registrati per Contattarci!</p>
            </div>
            <div class="row align-items-center form-group">
                <div class="col-md-3"></div>
                <input type="button" value="Accedi" onclick="window.location.href='login.php';" class="btnContact col-md-3" /><br><br>
                <input type="button" value="Registrati" onclick="window.location.href='registrazione.php';" class="btnContact col-md-3" /><br><br>
                <div class="col-md-3"></div>
            </div>
        </div>
    <?php }
    include("src/bottom.php"); ?>



    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ApebxY_q5st3QOmwTpZoUpSVHikbv3UwWZIXZ7jroGRZclt9JhOJjVJxEGz720Oh' async defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="javascript/map.js" type="text/javascript"></script>

</body>

</html>

<!--CREATE TABLE Utente (
    ruolo int PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(21) NOT NULL,
    cognome VARCHAR(21) NOT NULL,
    email VARCHAR(21) NOT NULL,
    pw VARCHAR(21) NOT NULL,
    foto_profilo VARCHAR(11) NOT NULL,
    
);

CREATE TABLE Auto (
    targa VARCHAR PRIMARY KEY,
    modello VARCHAR(21) NOT NULL,
    disponibilità BIT NOT NULL,
);

CREATE TABLE Servizio (
    id_servizio int PRIMARY KEY AUTO_INCREMENT,
    tipologia VARCHAR(21) NOT NULL,//trasporto van, luxury etc.
    data_inizio DATETIME NOT NULL,
    indirizzo_partenza VARCHAR(21) NOT NULL,
    indirizzo_arrivo VARCHAR(21) NOT NULL,
    prezzo FLOAT NOT NULL,

    fk_targa VARCHAR NOT NULL CONSTRAINT ha REFERENCES Auto(targa),
    fk_ruolo INT NOT NULL CONSTRAINT richiede REFERENCES Utente(ruolo)
);-->