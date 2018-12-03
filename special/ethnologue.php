<p>
  SIL International, provider of Ethnologue, has revoked access to this database because of an overdue payment. We expect access to be restored soon.</p>
<p>Most vendors understand the challenges in processing bills through educational institutions and take our word that payment will arrive, but SIL International has chosen not to do so.</p>
<p>For now you can access four pages for free at <a href="https://ezproxy.losrios.edu/login?url=https://www.ethnologue.com/">www.ethnologue.com</a>. Once you hit your limit, you can use an incognito/private browsing window to access more pages.</p>

<div id="hide-message"><button id="hide-page">In the future, go directly to ethnologue.com</button></div>
<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = 'expires='+d.toUTCString();
        document.cookie = 'skipPage-<?php echo $pTitle; ?>=skip;' + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to Ethnologue</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        });
        
        });


    
</script>
