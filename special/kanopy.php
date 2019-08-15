<p>
   <em>Warning:</em> when you are off-campus, after signing in through Los Rios, you may see a &quot;Create Your Account&quot; page, which urges you to create a Kanopy account.</p>
<img style="display:block; margin: 5px auto;max-width:400px;" src="special/kanopy-login.png" alt="Create Your Account page from Kanopy website">
<p>
   A Kanopy account is <strong>not required</strong> in order to watch Kanopy videos and, unless you read and agree to the terms and privacy policy, <strong>we recommend you do not create one</strong>.
</p>
<p>
   When the page appears, click the Kanopy logo at the top of the screen, or go to https://losrios.kanopy.com, and you will have access to the Los Rios Kanopy collection.
</p>   
   
<p>
   <em>Note:</em> to use Kanopy&apos;s apps (iOS, Android, Roku) you will need a Kanopy account.
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
