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

   
function validateRegistrerBetaling()
{

    var x = document.forms["tekstfelt"]["kortHolder"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["kortHolder"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Kortholder må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["kortNummer"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["kortNummer"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Kortnummer må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["CVV"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["CVV"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="CVV må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["totalPris"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["totalPris"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Total pris må fylles ut";
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
    document.getElementById("melding").innerHTML="Romtype ID må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["prisPerDogn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["prisPerDogn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Pris per døgn må fylles ut";
    return false;

    }
}
 
 function validateRegistrerRom()
 {
     var x = document.forms["tekstfelt"]["etasjer"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["etasjer"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Etasjer må fylles ut";
    return false;
    }

     var x = document.forms["tekstfelt"]["rom1"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["rom1"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Antall enkeltrom må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["rom2"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["rom2"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Antall dobbeltrom må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["rom3"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["rom3"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Antall suiter må fylles ut";
    return false;
    }
 }

 function validateLand()
 {
    var x = document.forms["tekstfelt"]["landID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["landID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Land ID må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["landNavn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["landNavn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Land navn må fylles ut";
    return false;
    }
}
function validateBy()
{
    var x = document.forms["tekstfelt"]["byID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["byID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="By-ID må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["byNavn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["byNavn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="By navn må fylles ut";
    return false;

    }
 }

function validateBestilling()
{
     var x = document.forms["tekstfelt"]["romtype"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romtype"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Romtypen må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["pris"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["pris"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Pris må fylles ut";
    return false;

    }

}

function validateBruker()
{
    var x = document.forms["tekstfelt"]["brukernavn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["brukernavn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Brukernavn må fylles ut";
    return false;

    }

    var x = document.forms["tekstfelt"]["passord"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["passord"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="passord må fylles ut";
    return false;

    }
}

function validateBetalingsmetode()
{
    var x = document.forms["tekstfelt"]["metodeID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["metodeID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Metode ID må fylles ut";
    return false;

    }

    var x = document.forms["tekstfelt"]["metodeNavn"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["metodeNavn"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Metode navn må fylles ut";
    return false;

    }
}

function validateRom2()
{
    var x = document.forms["tekstfelt"]["etasje"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["etasje"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Etasje må fylles ut";
    return false;
    }

    var x = document.forms["tekstfelt"]["rom1"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["rom1"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Antall enkeltrom må fylles ut";
    return false;

    }

    var x = document.forms["tekstfelt"]["rom2"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["rom2"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Antall dobbeltrom må fylles ut";
    return false;

    }

    var x = document.forms["tekstfelt"]["rom3"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["rom3"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Antall suiter må fylles ut";
    return false;

    }
}

function validateRom3()
{
    var x = document.forms["tekstfelt"]["romID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Rom-ID må fylles ut";
    return false;

    }

    var x = document.forms["tekstfelt"]["romtypeID"].value;
    if(x == null || x==""){
    document.forms["tekstfelt"]["romtypeID"].style.backgroundColor ="red";
    document.getElementById("melding").innerHTML="Romtype-ID må fylles ut";
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