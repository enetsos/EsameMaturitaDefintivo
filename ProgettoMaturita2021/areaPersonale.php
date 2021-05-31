<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css.css">
    <!--includo lo stile css-->

</head>

<body onload="init()">

    <!--menu-->
    <?php include("src/menu.php"); ?>

    <?php
    $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
    //definisco la query da eseguire
    $sql = "SELECT * FROM utente";
    //echo $sql."<BR>";
    //eseguo la query che restiuisce dei dati (un recordset $ris)
    $ris = mysqli_query($link, $sql) or die("non rieco ad eseguire la query");

    ?>

    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <img src=<?php
                        //se la foto profilo è non è stata cambiata dall'utente utilizzo l'immagine di default avatat.jpg
                        foreach ($ris as $riga) {
                            if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
                                if ($riga['foto_profilo'] != null)
                                    echo "" . $riga['foto_profilo'];
                                else
                                    echo "img/avatar.jpg";
                            }
                        }
                        ?> class="img-responsive col-md-2 avatarImage">
            <div class="col-md-1"></div>
            <h4 class="col-md-2 descriptionText" style="word-spacing: 150px;">
                <?php
                //stampo i dati dell'utente
                foreach ($ris as $riga) {
                    if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
                        echo "<br><br>" . $riga['nome'] . "&nbsp" . $riga['cognome'];
                    }
                }
                ?>
            </h4>
            <div class="col-md-3"></div>
        </div>
        <br><br>
        <div class="row text-center">
            <div class="col-md-3"></div>

            <input type="radio" name="optionSelection" class="optionRadio" id="corse" checked value="corse" onclick="refesh()">
            <label class="col-md-2 personalAreaText textRadio" for="corse" id="labelCorse">
                <h5><i class="fa fa-car" aria-hidden="true"></i> Corse</h5>
            </label>

            <input type="radio" name="optionSelection" class="optionRadio" id="message" value="message" onclick="refesh()">
            <label class="col-md-2 personalAreaText textRadio" for="message" id="labelMessage">
                <h5><i class="fa fa-envelope-o" aria-hidden="true"></i> Messaggi</h5>
            </label>

            <input type="radio" name="optionSelection" class="optionRadio" id="setting" value="setting" onclick="refesh()">
            <label class="col-md-2 personalAreaText textRadio" for="setting" id="labelSetting">
                <h5><i class="fa fa-cog" aria-hidden="true"></i> Impostazioni<h5>
            </label>

            <div class="col-md-3"></div>
        </div>

        <div id="divCorse">
        <!--stampo le corse attive dell'utente-->
            <div class="answer col-md-12">
                <div class="corsaPrint" id="corsaPrint"></div>
            </div>
        </div>

        <div id="divMessage">
            <?php
            $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");

            //sql select informazioni messaggio
            $slqGetMessaggio = "SELECT * FROM messaggio GROUP BY mittente";
            $risGetMessaggio = mysqli_query($link, $slqGetMessaggio) or die("non riesco ad eseguire la query");

            ?>
            <div class="answer col-md-12">
                <div id="chatBox"></div>
                <div class="row">
                    <div class="col-md-2"></div>

                    <span class="Logintext" for="messaggio"><b>Messaggio:</b></span><br>
                    <input type="text" class="Logininput col-md-8" name="messaggio" rows="4" cols="40" id="inputchat" placeholder="inserisci messaggio"></textarea>

                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-5"></div>
                    <input type="button" value="Invia" name="submit" class="btnContact col-md-2" id="inputBtn" onclick="writeMessage()" disabled />
                    <div class="col-md-5"></div>
                </div>

            </div>
        </div>

        <div id="divSetting">
            <?php
            $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
            //definisco la query da eseguire
            $sqlSelect = "SELECT * FROM utente";
            //echo $sql."<BR>";
            //eseguo la query che restiuisce dei dati (un recordset $ris)
            $risSelect = mysqli_query($link, $sqlSelect) or die("non rieco ad eseguire la query1");

            ?>
            <br><br><br><br>

            <form action="settigns.php" target="_self" method="post" class="container" enctype="multipart/form-data">
                <div class="row align-items-center">
                    <div class="col-md-3"></div>
                    <img src=<?php
                                foreach ($risSelect as $riga) {
                                    if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
                                        if ($riga['foto_profilo'] != null)
                                            echo "" . $riga['foto_profilo'];
                                        else
                                            echo "img/avatar.jpg";
                                    }
                                }
                                ?> class="img-responsive col-md-2 avatarImage">
                    <i class="fa fa-arrow-right descriptionText col-md-1" aria-hidden="true"></i>
                    <input type="file" name="avatarFoto" class="col-md-3">
                    <div class="col-md-3"></div>
                </div>
                <br><br>
                <div class="row align-items-center">
                    <div class="col-md-3"></div>
                    <h4 class="descriptionText col-md-3" style="word-spacing: 20px;">
                        <?php
                        foreach ($risSelect as $riga) {
                            if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
                                echo "" . $riga['nome'];
                            }
                        }
                        ?>
                    </h4>
                    <i class="fa fa-arrow-right descriptionText col-md-1" aria-hidden="true"></i>
                    <input type="text" name="nome" size="30" MAXsize=80 class="col-md-3 Logininput"><br><br>
                    <div class="col-md-2"></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-3"></div>
                    <h4 class="descriptionText col-md-3" style="word-spacing: 20px;">
                        <?php
                        foreach ($risSelect as $riga) {
                            if (($_COOKIE['keepLogEmail'] == $riga['email']) && ($_COOKIE["KeepLogRole"] = $riga['ruolo'])) {
                                echo "" . $riga['cognome'];
                            }
                        }
                        ?>
                    </h4>
                    <i class="fa fa-arrow-right descriptionText col-md-1" aria-hidden="true"></i>
                    <input type="text" name="cognome" size="30" MAXsize=80 class="col-md-3 Logininput"><br><br>
                    <div class="col-md-2"></div>
                </div>
                <div class="row align-items-center form-group">
                    <div class="col-md-3"></div>
                    <input type="submit" value="Modifica" name="submit" class="btnContact col-md-4" /><br><br>
                    <input type="button" value="Annulla" onclick="window.location.href='areaPersonale.php';" class="btnContact col-md-3" /><br><br>
                    <div class="col-md-3"></div>
                </div>
            </form>
            <br><br>


            <!--piè di pagina-->
            <?php mysqli_close($link);
            ?>
        </div>
    </div>
    <br><br>


    <!--piè di pagina-->
    <?php include("src/bottom.php"); ?>

    <script src="javascript/areapersonale.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>