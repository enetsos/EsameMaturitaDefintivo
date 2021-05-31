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
    <?php include("src/menu.php"); ?>


    <!--div del titolo-->
    <div class="container topTitle">
        <div class="row align-items-center">
            <div class="col-md-6"><b>Scopri le nostre auto per tutte le esigenze</b></div>
            <img class="img-responsive col-md-6" src="img/flotta.jpg" alt="flotta" width="600px">
        </div>
    </div>

    <br><br>

    <!--div parco macchine-->
    <div class="container">
        <div class="row text-center">
            <h5 class="col-md-12 descriptionTitle">Le auto più richieste</h5>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img class="img-responsive" src="img/standard.jpg" alt="tie">
                <h4 class="descriptionTitle">Standard</h4>
                <p class="descriptionText">Veicolo ideale per i piccoli spostamenti con un autista professionista.</p>
            </div>
            <div class="col-md-4">
                <img class="img-responsive" src="img/van.jpg" alt="man">
                <h4 class="descriptionTitle">Van</h4>
                <p class="descriptionText">Veicolo adatto al trasporto di più persone. Ideale per i pick-up aereoportuali.</p>
            </div>
            <div class="col-md-4">
                <img class="img-responsive" src="img/luxury.jpg" alt="car">
                <h4 class="descriptionTitle">Luxury</h4>
                <p class="descriptionText">Veicolo perfetto per una evento importante o per fare colpo su un cliente.</p>

            </div>
        </div>
    </div>
        <br><br>

        <!--div spiegazione servizi-->
        <div class="container descriptionText">
            <div class="row align-items-center">
                <img class="img-responsive col-md-6" src="img/porche.jpg" alt="porche" width="600px">
                <div class="col-md-6">
                    <h4 class="descriptionTitle"><i class="fa fa-clock-o" aria-hidden="true"></i> Corse su richiesta</h4>
                    <p class="descriptionText">Richiedi una corsa a qualsiasi ora e in qualsiasi giorno dell'anno.</p>

                    <h4 class="descriptionTitle"><i class="fa fa-money" aria-hidden="true"></i> Prezzi accessibili</h4>
                    <p class="descriptionText">Confronta i prezzi di tutte le opzioni di corsa, dai tragitti da pendolare giornalieri alle serate speciali.</p>

                    <h4 class="descriptionTitle"><i class="fa fa-map-marker" aria-hidden="true"></i> Ovunque tu voglia andare</h4>
                    <p class="descriptionText">Che tu voglia muoverti fuori città per una vacanza o all'aereoporto per un viaggio di lavoro, noi ci saremo.</p>

                </div>
            </div>
        </div>

        <div></div>

        <br><br>

        <!--piè di pagina-->
        <?php include("src/bottom.php"); ?>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>