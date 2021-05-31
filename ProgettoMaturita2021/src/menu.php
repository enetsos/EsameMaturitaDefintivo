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

    <?php
    session_start();

    $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
    //definisco la query da eseguire
    $sql = "SELECT * FROM utente";
    //echo $sql."<BR>";
    //eseguo la query che restiuisce dei dati (un recordset $ris)
    $ris = mysqli_query($link, $sql) or die("non rieco ad eseguire la query");

    //se non sono settati i cookie vuol dire che non si è effettuato il login
    if (!isset($_COOKIE["keepLogEmail"]) && !isset($_COOKIE["KeepLogRole"])) { ?>
        <!--div del menu non loggato-->
        <div class="container-fluid menu">
            <div class="row align-items-center text-center">
                <!--logo del sito-->
                <div class="col-md-2"><a href="home.php"><img class="img-responsive" id="imgLogo" src="img/logo_home.png" alt="logo"></a></div>
                <div class="col-md-1"><a href="chi_siamo.php"><b>CHI SIAMO</b><a></div>
                <div class="col-md-1"><a href="auto.php"><b>AUTO</b></a></div>
                <div class="col-md-1"><a href="contatto.php"><b>CONTATTO</b></a></div>
                <div class="col-md-4"></div>
                <div class="col-md-1 dropdown ">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Aziende</a>
                        <a class="dropdown-item" href="#">Privati</a>
                        <a class="dropdown-item" href="#">Noleggio Auto</a>
                        <a class="dropdown-item" href="#">Merci Urgenti</a>
                    </div>
                </div>
                <button class="btn active col-md-1 btnLogin" onclick="window.location.href='login.php';"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Accedi</button>

                <button class="btn active col-md-1" id="btnSignUp" onclick="window.location.href='registrazione.php';">Registrati</button>
            </div>
        </div>
    <?php } else { ?>
        <div class="container-fluid menu">
            <div class="row align-items-center text-center">
                <!--logo del sito-->
                <div class="col-md-2"><a href="home.php"><img class="img-responsive" id="imgLogo" src="img/logo_home.png" alt="logo"></a></div>
                <div class="col-md-1"><a href="chi_siamo.php"><b>CHI SIAMO</b><a></div>
                <div class="col-md-1"><a href="auto.php"><b>AUTO</b></a></div>
                <div class="col-md-1"><a href="contatto.php"><b>CONTATTO</b></a></div>
                <div class="col-md-5"></div>
                <div class="col-md-1 dropdown ">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Aziende</a>
                        <a class="dropdown-item" href="#">Privati</a>
                        <a class="dropdown-item" href="#">Noleggio Auto</a>
                        <a class="dropdown-item" href="#">Merci Urgenti</a>
                    </div>
                </div>

                <div class="col-md-1 dropdown" id="dropdownMenu">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                        <img src=<?php
                        //stampo la foto profilo di defalut se non è stata cambiata dall'utente
                                    foreach ($ris as $riga) {
                                        if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
                                            if ($riga['foto_profilo'] != null)
                                                echo "" . $riga['foto_profilo'];
                                            else
                                                echo "img/avatar.jpg";
                                        }
                                    }
                                    ?> class="img-responsive avatarImage" style="width: 60px;">
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href=<?php
                        //se ruolo admin -> admin.php, se ruolo normal -> areaPersonale.php
                                                        if (($_COOKIE['keepLogEmail'] == "jetw.ncc@gmail.com") && ($_COOKIE["KeepLogRole"] == "admin")) 
                                                            echo "admin.php";
                                                         else  
                                                            echo "areaPersonale.php";
                                                        ?>>Area Personale</a>
                        <a class="dropdown-item " href="home.php" onclick="dropLoginCookie();">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    mysqli_close($link); ?>

<script src="javascript/cookie.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>