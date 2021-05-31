
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

    <br><br><br><br><br>
    <?php
    //salt che conosce solo lo sviluppatore
    $salt = "salt";
    if (isset($_POST['submit'])) {
        
        //prendo i dati inviati POST
        $email = $_POST['email'];
        $pw = md5($salt . $_POST['password']);
        $count = 0;

        //connessione al databaase
        $link = mysqli_connect("127.0.0.1", "root", "", "drivetransporter") or die("non riesco a connettermi al database");
        //definisco la query da eseguire
        $sql = "SELECT * FROM utente";
        $ris = mysqli_query($link, $sql) or die("non riesco ad eseguire la query select");
        //cerco nome e password nella tabella utenti
        foreach ($ris as $riga) {
            if (($riga['email'] == $email) && ($riga['pw'] == $pw)) { //login con successo
                echo "loggato con successo";
                setcookie("keepLogEmail", $riga['email'], time() + 7200, '/');
                setcookie("KeepLogRole", $riga['ruolo'], time() + 7200, '/');
                header("Refresh:0; url=home.php");
                break;
            } else if ($riga['email'] != $email || ($riga['pw'] != $pw)) { //password o email sbagliata
                $count++;
            }
        }
        //se non esistono email o passsword nel dtb vuol dire che email o password sono sbagliate o inestistenti
        if(mysqli_num_rows($ris) == $count){
            echo '<script type="text/javascript">',
                'alert("password o email sbagliata");',
                '</script>';
                header("Refresh:0; url=login.php");
        }
        mysqli_close($link);
    } else {
    ?>
        <form action="login.php" target="_self" method="post" class="container-fluid">
            <div class="row align-items-center form-group">
                <div class="col-md-3"></div>
                <span class="col-md-3 Logintext" for="email"><b>EMAIL</b></span>
                <input type="text" name="email" size="30" MAXsize=80 class="col-md-3 Logininput"><br><br>
                <div class="col-md-3"></div>
            </div>
            <div class=" row align-items-center form-group">
                <div class="col-md-3"></div>
                <span class="col-md-3 Logintext" for="password"><b>PASSWORD</b></span>
                <input type="password" name="password" class="col-md-3 Logininput"/><br> <br>
                <div class="col-md-3"></div>
            </div>
            <div class="row align-items-center form-group">
                <div class="col-md-3"></div>
                <input type="submit" value="Sign In" name="submit" class="btnContact col-md-3" /><br><br>
                <input type="button" value="Sign Up" onclick="window.location.href='registrazione.php';" class="btnContact col-md-3" /><br><br>                
                <div class="col-md-3"></div>
            </div>
        </form>

    <?php
    }
    ?>

    <!--piè di pagina-->
    <?php include("src/bottom.php"); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
