<p>Nexis Uni is currently not working correctly when accessed from off-campus.</p>
<p>Until this problem is resolved, please take the following steps:
</p>
<ol>
    <li>
   Register for a Nexis Uni account: <a href="https://0-signin-lexisnexis-com.lasiii.losrios.edu/lnaccess/UserRegistration?lookup=1">https://0-signin-lexisnexis-com.lasiii.losrios.edu/lnaccess/UserRegistration?lookup=1</a>
     </li>
     <li>Once you&apos;ve registered, go directly to <a class="db-name" href="http://www.nexisuni.com">www.nexisuni.com</a> and sign in to use Nexis Uni. Note that when you are on campus, you might not need to sign in to use the database.</li>
</ol>
<div id="hide-message"><button id="hide-page">In the future, go directly to www.nexisuni.com</button></div>

<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = 'expires='+d.toUTCString();
        document.cookie = 'skipPage-<?php echo $pTitle; ?>=skip;' + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to  www.nexisuni.com</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        });
        
        });


    
</script>
