/**gestisco areaPersonale.php */
var emailMittente = "jetw.ncc@gmail.com";

//inizializzo le variabili e start funzioni ajax
function init() {
    var divCorse = document.getElementById("divCorse");
    var divMessage = document.getElementById("divMessage");
    var divSetting = document.getElementById("divSetting");
    var corsaPrint = document.getElementById("corsaPrint");

    //console.log(divAddCardivContatto, divSetting);
    refesh();
    readMessage();
    getCorsa();
}

//switch menu
function refesh() {
    if (document.getElementById("corse").checked) {
        divMessage.style.display = "none";
        divSetting.style.display = "none";
        divCorse.style.display = "inline";
        document.getElementById("labelCorse").style.textDecoration = "underline";
        document.getElementById("labelMessage").style.textDecoration = "none";
        document.getElementById("labelSetting").style.textDecoration = "none";

    } else if (document.getElementById("message").checked) {
        divCorse.style.display = "none";
        divSetting.style.display = "none";
        divMessage.style.display = "inline";
        document.getElementById("labelMessage").style.textDecoration = "underline";
        document.getElementById("labelSetting").style.textDecoration = "none";
        document.getElementById("labelCorse").style.textDecoration = "none";
    } else if (document.getElementById("setting").checked) {
        divCorse.style.display = "none";
        divMessage.style.display = "none";
        divSetting.style.display = "inline";
        document.getElementById("labelSetting").style.textDecoration = "underline";
        document.getElementById("labelCorse").style.textDecoration = "none";
        document.getElementById("labelMessage").style.textDecoration = "none";
    }

}

//scrivo messaggio con ajax
function writeMessage() {
    var answer = document.getElementById("inputchat").value;
    var http = new XMLHttpRequest(message);
    console.log(emailMittente);
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var response = http.responseText;
            document.innerHTML = response;
            console.log(response);
        }
    };
    http.open("GET", "php/insertChat.php" + "?message=" + answer + "&dest=" + emailMittente, true);
    http.send(null);
}

//leggo messaggio con ajax
function readMessage() {
    var chatBox = document.getElementById("chatBox");
    chatBox.innerHTML = "";
    setInterval(() => {
        var http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                var response = http.responseText;
                chatBox.innerHTML = response;
                document.getElementById("inputBtn").disabled = false;
            }
        };
        http.open("GET", "php/getChatNormal.php" + "?idu=" + emailMittente, true);
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
        http.open("GET", "php/getCorsaNormal.php", true);
        http.send(null);
    }, 500);

}