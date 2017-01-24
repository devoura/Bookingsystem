$(document).ready(function() {

        var husk = $.cookie('husk');
        if (husk=='true') 
        {
            var brukernavn = $.cookie('brukernavn');
            var passord = $.cookie('passord');
            // autofill feltene
            $('#brukernavn').val(brukernavn);
            $('#passord').val(passord);
        }


    $("#innloggingsskjema").submit(function() {
        if ($('#husk').is(':checked')) {
            var brukernavn = $('#brukernavn').val();
            var passord = $('#passord').val();

            // cookies går ut om 14 dager
            $.cookie('brukernavn', brukernavn, { expires: 14 });
            $.cookie('passord', passord, { expires: 14 });
            $.cookie('husk', true, { expires: 14 });                
        }
        else
        {
            // reset cookies
            $.cookie('brukernavn', null);
            $.cookie('passord', null);
            $.cookie('husk', null);
        }
  });
});