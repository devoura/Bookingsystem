function visHotell(byID)
{
  var request=new XMLHttpRequest();  /* oppretter request-objekt */
  
  request.onreadystatechange=response;  /* angir respons-funksjon */
  
  request.open("GET","ajax-vis-hotell.php?byID="+byID);  /* angir metode og URL */
  request.send();  /* sender en request */

  function response()
  {
    if (request.readyState==4 && request.status==200)  /* responsen er fullført og vellykket */
      {
        document.getElementById("melding2").innerHTML=request.responseText;
        document.getElementById("melding3").innerHTML="";  /* responsteksten legges i meldingsfeltet */
      }
  }
}