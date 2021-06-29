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
    <div class="container principal">
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
            <div class="col-md-4"></div>
        </div>
        <br><br>
        <div class="row text-center">
            <div class="col-md-2"></div>

            <input type="radio" name="optionSelection" class="optionRadio" id="addCar" checked value="addCar" onclick="refesh()">
            <label class="col-md-2 personalAreaText textRadio" for="addCar" id="labelAddCar">
                <h5><i class="fa fa-car" aria-hidden="true"></i> Aggiungi Auto</h5>
            </label>

            <input type="radio" name="optionSelection" class="optionRadio" id="message" value="message" onclick="refesh()">
            <label class="col-md-3 personalAreaText textRadio" for="message" id="labelMessage">
                <h5><i class="fa fa-envelope-o" aria-hidden="true"></i> Corse/Messaggi</h5>
            </label>

            <input type="radio" name="optionSelection" class="optionRadio" id="setting" value="setting" onclick="refesh()">
            <label class="col-md-2 personalAreaText textRadio" for="setting" id="labelSetting">
                <h5><i class="fa fa-cog" aria-hidden="true"></i> Impostazioni<h5>
            </label>

            <div class="col-md-3"></div>
        </div>

        <div id="divAddCar">
            <form class="container" action="php/addCar.php" method="post" style="padding-top: 50px;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <span class="Logintext" for="targa"><b>Targa:</b></span><br>
                        <input type="text" name="targa" class="Logininput" id="targa" MAXsize=80><br>
                    </div>
                    <div class="col-md-3">
                        <span class="Logintext" for="marca"><b>Marca:</b></span><br>
                        <input type="text" name="marca" class="Logininput" id="marca" MAXsize=80 autocomplete="off">
                    </div>
                    <div class="col-md3">
                        <span class="Logintext" for="modello"><b>Modello:</b></span><br>
                        <input type="text" name="modello" class="Logininput" id="modello" MAXsize=80><br><br>
                    </div>


                    <div class="col-md-2"></div>
                </div>

                <div class="row text-center align-items-center">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <input type="radio" class="form-check-input Logininput col-md-1" name="disponibile" id="sidisponibile" value="disponibile" checked></input>
                        <label class="form-check-label Logintext col-md-2 textRadio" for="sidisponibile"><b>Disponibilie</b></label>
                    </div>
                    <div class="col-md-4">
                        <input type="radio" class="form-check-input Logininput col-md-1" name="disponibile" id="nonDisponibile" value="indisponibile"></input>
                        <label class="form-check-label Logintext col-md-2 textRadio" for="nonDisponibile"><b>Indisponibile</b></label>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5"></div>
                    <input type="submit" value="Aggiungi" name="addCar" class="btnContact col-md-2" id="addCarBtn" />
                    <div class="col-md-2"></div>
                    <p class="descriptionText col-md-4" id="addCarResult"></p>
                </div>
            </form>
            
            <div class="answer col-md-12">
                <div id="autoPrint"></div>
            </div>
        </div>



        <div id="divMessage">
            <div class="row">

                <?php
                $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");

                $slqGetMessaggio = "SELECT * FROM messaggio GROUP BY mittente ORDER BY mittente";
                $risGetMessaggio = mysqli_query($link, $slqGetMessaggio) or die("non riesco ad eseguire la query");

                $idInfoText = "info";
                $count = 0;

                //stampo gli utenti che hanno contattato admin
                foreach ($risGetMessaggio as $riga) {
                    if (($_COOKIE['keepLogEmail'] == $riga['destinatario'])) { ?>

                        <div class="col-md-3 chatUtente" id='<?php echo "$idInfoText" . "$count" ?>' onclick="readMessage('<?php echo $riga['mittente'] ?>', <?php echo $count ?>)">
                            <p class="form-check-label Logintext "><b>Utente</b></p>
                            <p class="descriptionText"><?php echo "" . $riga["mittente"]; ?></p>
                        </div>
                <?php
                        $count++;
                    }
                }
                ?>
            </div>
            <br>
            <div class="answer col-md-12">
                <div id="chatBox"></div>
                <div class="row">
                    <div class="col-md-2"></div>

                    <span class="Logintext" for="messaggio"><b>Messaggio:</b></span><br>
                    <input type="text" class="Logininput col-md-8" name="messaggio" rows="4" cols="40" id="inputchat" value="ciao"></textarea>

                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-5"></div>
                    <input type="button" value="Invia" name="submit" class="btnContact col-md-2" id="inputBtn" onclick="writeMessage()" disabled />
                    <div class="col-md-5"></div>
                </div>
            </div>

            <form class="container" action="php/addCorsa.php" method="post" style="padding-top: 50px;">
                <div class="row">
                    <div class="col-md-5"></div>
                    <h5 class="col-md-2 descriptionTitle">Nuova Corsa</h5>
                    <div class="col-md-5"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">

                        <span class="Logintext" for="start"><b>Tipologia:</b></span><br>
                        <select class="form-select" aria-label="Default select example" name="tipologia" id="tipologia">
                            <option value="Standard">Standard</option>
                            <option value="Van">Van</option>
                            <option value="Luxury">Luxury</option>
                        </select><br>

                        <span class="Logintext" for="date"><b>Data e Ora di Partenza:</b></span><br>
                        <input type="datetime-local" name="date" class="Logininput" MAXsize=80 id="date"><br><br>

                        <span class="Logintext" for="start"><b>Partenza:</b></span><br>
                        <div id="startAutosuggestion"><input type="text" name="start" class="Logininput" id="start" MAXsize=80 onchange="loadRoutes()"></div><br>

                        <span class="Logintext" for="end"><b>Arrivo:</b></span><br>
                        <div id="endAutosuggestion"><input type="text" name="end" class="Logininput" id="end" MAXsize=80 onchange="loadRoutes()"></div><br>

                        <span class="Logintext" for="emailCliente"><b>Email Cliente:</b></span><br>
                        <input type="tel" name="emailCliente" class="Logininput" id="emailCliente" MAXsize=8><br><br>

                        <span class="Logintext" for="telephone"><b>Numero di Telefono Cliente:</b></span><br>
                        <input type="tel" name="telephone" class="Logininput" id="telephone" MAXsize=80 pattern="[0-9]{10}"><br><br>

                        <span class="Logintext" for="prezzo"><b>Prezzo:</b></span><br>
                        <div id="startAutosuggestion"><input type="number" name="prezzo" id="prezzo" class="Logininput" id="prezzp" MAXsize=80></div><br>

                        <span class="Logintext" for="auto"><b>Targa Auto:</b></span><br>
                        <div id="endAutosuggestion"><input type="text" name="auto" class="Logininput" id="auto" MAXsize=80></div><br>

                        <br>
                        <input type="submit" value="Invia" name="submit" class="btnContact" id="addCorsaBtn" />
                    </div>
                    <div class="col-md-4 map" id="map"></div>
                </div>
            </form><!--
            <div class="answer col-md-12">
                <div class="corsaPrint"></div>
            </div>-->

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
    <?php
    include("src/bottom.php"); ?>

    <script src="javascript/adminPersonal.js" type="text/javascript"></script>
    <script src="javascript/map.js" type="text/javascript"></script>
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ApebxY_q5st3QOmwTpZoUpSVHikbv3UwWZIXZ7jroGRZclt9JhOJjVJxEGz720Oh' async defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="bootstrap-autocomplete.min.js"></script>
</body>

</html>