function visFrokost(hotellID)
{
  var request=new XMLHttpRequest();  /* oppretter request-objekt */
  
  request.onreadystatechange=response;  /* angir respons-funksjon */
  
  request.open("GET","ajax-vis-frokost.php?hotellID="+hotellID);  /* angir metode og URL */
  request.send();  /* sender en request */

  function response()
  {
    if (request.readyState==4 && request.status==200)  /* responsen er fullført og vellykket */
      {
        document.getElementById("melding3").innerHTML=request.responseText;  /* responsteksten legges i meldingsfeltet */
      }
  }
}