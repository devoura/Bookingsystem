function validertommefelt() {

var x = document.forms["tekstfelt"].value;
if(x == null || x == ""){
document.forms["tekstfelt"]["input"].style.backgroundColor = "red";
document.getElementById("melding").innerHTML="Felt må fylles ut";
return false;
}
}