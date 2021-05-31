/**gestione admin.php */
var count = true;
var emailMittente
var interval = new Array();

//inizializzo le variabili e start funzioni ajax
function init() {
    var divAddCar = document.getElementById("divAddCar");
    var divMessage = document.getElementById("divMessage");
    var divSetting = document.getElementById("divSetting");
    var chatBox = document.getElementById("chatBox");
    var autoPrint = document.getElementById("autoPrint");
    var corsaPrint = document.getElementById("corsaPrint");

    $(document).ready(function() {
        $(this).scrollTop(0);
    });
    //console.log(divAddCar, divMessage, divSetting);
    refesh();
    getCar();
    getCorsa();
}

//switch menu
function refesh(CountMessage) {
    if (document.getElementById("addCar").checked) {
        divMessage.style.display = "none";
        divSetting.style.display = "none";
        divAddCar.style.display = "inline";
        document.getElementById("labelAddCar").style.textDecoration = "underline";
        document.getElementById("labelMessage").style.textDecoration = "none";
        document.getElementById("labelSetting").style.textDecoration = "none";

    } else if (document.getElementById("message").checked) {
        divAddCar.style.display = "none";
        divSetting.style.display = "none";
        divMessage.style.display = "inline";
        document.getElementById("labelMessage").style.textDecoration = "underline";
        document.getElementById("labelSetting").style.textDecoration = "none";
        document.getElementById("labelAddCar").style.textDecoration = "none";
    } else if (document.getElementById("setting").checked) {
        divAddCar.style.display = "none";
        divMessage.style.display = "none";
        divSetting.style.display = "inline";
        document.getElementById("labelSetting").style.textDecoration = "underline";
        document.getElementById("labelAddCar").style.textDecoration = "none";
        document.getElementById("labelMessage").style.textDecoration = "none";
    }

}

//scrivo messaggio con ajax
function writeMessage() {
    var answer = document.getElementById("inputchat").value;
    var http = new XMLHttpRequest(message);
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var response = http.responseText;
            document.innerHTML = response;
        }
    };
    http.open("GET", "php/insertChat.php" + "?message=" + answer + "&dest=" + emailMittente, true);
    http.send(null);
}

//leggo messaggio con ajax
function readMessage(mittente, idInterval) {
    chatBox.innerHTML = "";
    for (i = 0; i < interval.length; i++) {
        if (i != idInterval) {
            clearInterval(interval[i]);
        }
    }

    interval[idInterval] = setInterval(() => {
        emailMittente = mittente;
        var http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                var response = http.responseText;
                chatBox.innerHTML = response;
                document.getElementById("inputBtn").disabled = false;
            }
        };
        http.open("GET", "php/getChatAdmin.php" + "?idu=" + emailMittente, true);
        http.send(null);
    }, 500);

}

//leggo auto con ajax
function getCar() {
    setInterval(() => {
        var http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                var response = http.responseText;
                autoPrint.innerHTML = response;
            }
        };
        http.open("GET", "php/getAuto.php", true);
        http.send(null);
    }, 500);

}

//leggo corse con ajax
function getCorsa() {
    setInterval(() => {
        var http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                var response = http.responseText;
                corsaPrint.innerHTML = response;
            }
        };
        http.open("GET", "php/getCorsa.php", true);
        http.send(null);
    }, 500);

}

//gestisco form addCar con ajax
$(document).ready(function() {
    //al click sul bottone del form
    document.querySelector("#addCarBtn").addEventListener("click", function(event) {

        event.preventDefault();
        //associo variabili
        var targa = $("#targa").val();
        var marca = $("#marca").val();
        var modello = $("#modello").val();
        var disponibile = $('input[name="disponibile"]:checked').val();


        //chiamata ajax
        $.ajax({

            //imposto il tipo di invio dati (GET O POST)
            type: "POST",

            //Dove devo inviare i dati recuperati dal form?
            url: "php/addCar.php",

            //Quali dati devo inviare?
            data: "targa=" + targa + "&marca=" + marca + "&modello=" + modello + "&disponibile=" + disponibile,
            dataType: "html",

            //Inizio visualizzazione errori
            success: function(msg) {
                document.querySelector("#targa").value = "";
                document.querySelector("#marca").value = "";
                document.querySelector("#modello").value = "";
                document.querySelector("#addCarResult").innerHTML = "Inserimento effettuato con successo!";
                setTimeout(() => {
                    document.querySelector("#addCarResult").innerHTML = "";
                }, 2000);
            },
            error: function() {
                alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
            }
        });
    });
});

//gestisco form addCorsa con ajax
$(document).ready(function() {
    //al click sul bottone del form
    document.querySelector("#addCorsaBtn").addEventListener("click", function(event) {

        event.preventDefault();
        //associo variabili
        var tipologia = $("#tipologia").val();
        var datetime = $("#date").val();
        var indPartenza = $("#start").val();
        var indArrivo = $("#end").val();
        var emailCliente = $("#emailCliente").val();
        var telefono = $("#telephone").val();
        var prezzo = $("#prezzo").val();
        var targa = $("#auto").val();

        //chiamata ajax
        $.ajax({

            //imposto il tipo di invio dati (GET O POST)
            type: "POST",

            //Dove devo inviare i dati recuperati dal form?
            url: "php/addCorsa.php",

            //Quali dati devo inviare?
            data: "tipologia=" + tipologia + "&date=" + datetime + "&indPartenza=" + indPartenza +
                "&indArrivo=" + indArrivo + "&emailCliente=" + emailCliente + "&telefono=" + telefono + "&prezzo=" + prezzo + "&targa=" + targa,
            dataType: "html",

            //Inizio visualizzazione errori
            success: function(msg) {
                document.querySelector("#date").value = "";
                document.querySelector("#start").value = "";
                document.querySelector("#end").value = "";
                document.querySelector("#emailCliente").value = "";
                document.querySelector("#telephone").value = "";
                document.querySelector("#prezzo").value = "";
                document.querySelector("#auto").value = "";
            },
            error: function() {
                alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
            }
        });
    });
});