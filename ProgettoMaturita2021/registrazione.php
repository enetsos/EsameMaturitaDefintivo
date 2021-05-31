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
    <br><br><br><br><br>
    <?php
    //salt che conosce solo lo sviluppatore
    $salt = "salt";
    if (isset($_POST['submit'])) {
        //prendo i dati inviati POST
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email'];
        $pw = md5($salt . $_POST['password']);
        $ruolo = "normal";

        if ($nome != "" && $cognome != "" && $email != "" && $pw != "") {
            //connessione al databaase
            $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");

            //sql select email per verificare che non sia già presente nel dtb
            $sqlCheckEmail = "SELECT email FROM utente WHERE email = '$email'";
            $risCheckEmail = mysqli_query($link, $sqlCheckEmail);

            //se email è già presente, alert("email già in uso"); reload altrimenti inserisco i dati nel dtb
            if (mysqli_num_rows($risCheckEmail) > 0) {
                echo '<script type="text/javascript">',
                'alert("email già in uso! ");',
                '</script>';
                mysqli_close($link);
            } else {
                //definisco la query da eseguire
                $sql = "INSERT INTO utente (nome,cognome,email,pw,ruolo) VALUES ('" . $nome . "','" . $cognome . "','" . $email . "','" . $pw . "','" . $ruolo . "')";
                echo $sql;
                //eseguo la query che non restiutisce niente
                mysqli_query($link, $sql) or die("non rieco ad eseguire la query");
                //inserimentoi effettuato corrttamente!!!
                mysqli_close($link);
                header("Refresh:0; url=login.php");
            }
        } else {
            echo "<script type='text/javascript'>alert('inserire i campi!');</script>";
            header("Refresh:0");
        }
    ?>
    <?php }
    ?>
    <form action="registrazione.php" target="_self" method="post" class="container-fluid">
        <div class="row align-items-center form-group">
            <div class="col-md-3"></div>
            <span class="col-md-3 Logintext" for="nome"><b>NOME</b></span>
            <input type="text" name="nome" size="30" MAXsize=80 class="col-md-3 Logininput" id="nome"><br><br>
            <div class="col-md-3"></div>
        </div>
        <div class=" row align-items-center form-group">
            <div class="col-md-3"></div>
            <span class="col-md-3 Logintext" for="cognome"><b>COGNOME</b></span>
            <input type="text" name="cognome" class="col-md-3 Logininput" id="cognome" /><br> <br>
            <div class="col-md-3"></div>
        </div>
        <div class=" row align-items-center form-group">
            <div class="col-md-3"></div>
            <span class="col-md-3 Logintext" for="email"><b>EMAIL</b></span>
            <input type="text" name="email" class="col-md-3 Logininput" id="email" /><br> <br>
            <p id="emailSbagliata"></p>
            <div class="col-md-3"></div>
        </div>
        <div class=" row align-items-center form-group">
            <div class="col-md-3"></div>
            <span class="col-md-3 Logintext" for="password"><b>PASSWORD</b></span>
            <input type="password" name="password" class="col-md-3 Logininput" id="pw" /><br> <br>
            <div class="col-md-3"></div>
        </div>
        <div class="row align-items-center form-group">
            <div class="col-md-4"></div>
            <input type="submit" value="Sign Up" name="submit" class="btnContact col-md-4" id="submit" /><br><br>
            <div class="col-md-4"></div>
        </div>
    </form>



    <!--piè di pagina-->
    <?php include("src/bottom.php"); ?>

    <script src="javascript/registrazione.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>