<p>
   Many Kanopy films are currently unavailable because the Library has run out of funds to spend on them.
</p>
<p>If you need a film, please fill out the request form on the film&apos;s page, and specify the reason you need it. We will be able to fill requests as funds become available.</p>
<p>During Summer Recess and Summer Session, the requests will not be monitored.</p>
<p><a href="<?php echo $url; ?>" class="db-name">Continue to Kanopy</a></p>
<div id="hide-message" style="text-align:right;"><button id="hide-page">In the future, go directly to Kanopy</button></div>
<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = 'expires='+d.toUTCString();
        document.cookie = 'skipPage-<?php echo $pTitle; ?>=skip;' + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to Kanopy</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        
        });
        
        });


    
</script>
