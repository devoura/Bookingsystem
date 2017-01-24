<script type='text/javascript'>

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem( 'firstLoad' ) )
    {
      localStorage[ 'firstLoad' ] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem( 'firstLoad' );
  }
})();

</script>
<head>
<LINK href="logginn.css" rel="stylesheet" type="text/css">
<script src="jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="cookieScript/jquery.cookie.js"></script>
<script type="text/javascript" src="logginn.js"></script>
</head>

<form method="post" name="innloggingsskjema" id="innloggingsskjema" action="">
Brukernavn <br/ ><input type="text" name="brukernavn" id="brukernavn"><br />
Passord <br/ ><input type="password" name="passord" id="passord"><br />
<input type="submit" id="logginnknapp" name="logginnknapp" value="Logg inn"><br />
 <input type="checkbox" name="husk" id="husk" class="custom" checked="true" />
            <label for="husk">Husk meg?</label>
</form><br />

<?php

@$logginnknapp=$_POST["logginnknapp"];

if ($logginnknapp) {

$brukernavn=$_POST["brukernavn"];
$passord=$_POST["passord"];
	include ("sjekk.php");


	if (!sjekkbrukernavnpassord($brukernavn, $passord)) {
        }
    else 		
        {
        session_start();
        $_SESSION['brukernavn'] = $brukernavn;  
        print("<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>"); 
        }


}

?>