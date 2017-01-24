 function bekreft () {
 alert ("Er du sikker?");
 }
 
 function validateRegistrerKunde()
{
var x = document.forms["tekstfelt"]["tittel"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["tittel"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Tittel må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["fornavn"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["fornavn"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Fornavn må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["etternavn"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["etternavn"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Etternavn må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["by"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["by"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="By må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["postnr"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["postnr"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Postnummer må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["adresse"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["adresse"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Adresse må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["tlfnr"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["tlfnr"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Telefonnummer må fylles ut";
return false;
}

var x = document.forms["tekstfelt"]["email"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["email"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Email må fylles ut";
return false;
}

}

function validateRegistrerRomType()
{

    var x = document.forms["tekstfelt"]["romtype"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romtype"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Romtypen må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["romtypeID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romtypeID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Romtype ID fylles ut";
    return false;
    }

        var x = document.forms["tekstfelt"]["prisPerDogn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["prisPerDogn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Pris per døgn fylles ut";
    return false;
    }
}
   
function validateRegistrerBetaling()
{

    var x = document.forms["tekstfelt"]["kortHolder"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["kortHolder"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["kortNummer"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["kortNummer"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["CVV"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["CVV"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["totalPris"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["totalPris"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;
    }
}

function validateRegistrerRomType()
{

    var x = document.forms["tekstfelt"]["romtype"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romtype"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["romtypeID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romtypeID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;
    }

        var x = document.forms["tekstfelt"]["prisPerdogn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["prisPerDogn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Må fylles ut";
    return false;

    }
}

//sjekker om det er en gyldig email

        function validateEmail(email) {
            var chrbeforAt = email.substr(0, email.indexOf('@'));
            if (!($.trim(email).length > 127)) {
                if (chrbeforAt.length >= 2) {
                    var re = /^(([^<>()[\]{}'^?\\.,!|//#%*-+=&;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
                    return re.test(email);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
