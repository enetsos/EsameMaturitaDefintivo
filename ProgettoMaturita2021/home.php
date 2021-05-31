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
    ?>


    <!--div del titolo-->
    <div class="container-fluid topTitle">
        <div class="row align-items-center text-center">
            <div class="col-md-12"><b>Drivetransporter Swiss</b></div>
            <p class="col-md-12 topSubTitle">Limousine con e senza autista per aziende, privati e molto altro</p>
            </div>


        </div>
    </div>

    <br><br><br>

    <!--in dettaglio...-->
    <div class="container-fluid">
        <div class="row align-items-center text-center">
            <h2 class="col-md-12">Servizi</h2>
            <h5 class="col-md-12 description">Scegli il meglio e scopri i nostri servizi di trasporto</h5>
        </div>
    </div>

    <br>

    <!--immagini con descrizione dei servizi-->
    <div class="container">
        <div class="row text-center">
            <a href="#" class="col-md-4 serviceLink">
                <div>
                    <img class="img-responsive" src="img/tie_icon.png" alt="tie">
                    <h4 class="descriptionTitle">Aziende</h4>
                    <p class="descriptionText">Tutti i servizi di limousine con autista, dai transfer, organizzazione ed effettuazione di viaggi, trasporti urgenti di merci.</p>
                </div>
            </a>
            <a href="#" class="col-md-4 serviceLink">
                <div>
                    <img class="img-responsive" src="img/man_icon.png" alt="man">
                    <h4 class="descriptionTitle">Privati</h4>
                    <p class="descriptionText">Tutti i servi di limousine con autista dedicati a te e alla tua famiglia.</p>
                </div>
            </a>
            <a href="#" class="col-md-4 serviceLink">
                <div>
                    <img class="img-responsive" src="img/car_icon.png" alt="car">
                    <h4 class="descriptionTitle">Noleggio Auto</h4>
                    <p class="descriptionText">Noleggio autovetture di alta gamma senza il conducente.</p>
                </div>
            </a>
        </div>
    </div>
    <br>
    <div class="container descriptionRow">
        <div class="row text-center">
            <div class="col-md-4"></div>
            <a href="#" class="col-md-4 serviceLink">
                <div>
                    <img class=" img-responsive" src="img/box_icon.png" alt="box">
                    <h4 class="descriptionTitle">Trasporto Merci</h4>
                    <p class="descriptionText">Servizi di trasporto merci urgenti per tratte nazionali ed internazionali.</p>
                </div>
            </a>
            <div class="col-md-4"></div>
        </div>
    </div>
    <hr>

    <!--piè di pagina-->
    <?php include("src/bottom.php"); ?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>