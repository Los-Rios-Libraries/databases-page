<p>
   <em>Note:</em> When you sign in to Kanopy, you will see some buttons that say <em>Log in to Los Rios</em> and others that just say <em>Log in</em>.
</p>
<p>
   It is important that you only click the buttons that say <em>Log in to Los Rios</em>. The other buttons are for personal Kanopy accounts. These are needed for Kanopy apps used on mobile devices, Roku etc. A personal account is not needed for viewing Kanopy on a desktop or laptop computer.
</p>
<p><strong>Faculty:</strong> if you need a Kanopy video we do not have access to, please fill out the request form on the video&apos;s page, and specify the reason you need it. We will fill requests as funding allows.</p>
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
