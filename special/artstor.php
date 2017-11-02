<p>
   Artstor is currently experiencing problems when accessed from off-campus.</p>
<p>Until this problem is resolved, please take the following steps:
</p>
<ol>
    <li>
    Register for an Artstor account at <a href="https://0-library-artstor-org.lasiii.losrios.edu/#/register">https://0-library-artstor-org.lasiii.losrios.edu/#/register</a> 
        
    </li>
 
     <li>Once you&apos;ve registered, go directly to <a class="db-name" href="https://library.artstor.org">https://library.artstor.org</a> and log in to use Artstor.</li>
</ol>
<div id="hide-message"><button id="hide-page">In the future, go directly to library.artstor.org</button></div>
<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = 'expires='+d.toUTCString();
        document.cookie = 'skipPage-<?php echo $pTitle; ?>=skip;' + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to Artstor</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        });
        
        });


    
</script>
