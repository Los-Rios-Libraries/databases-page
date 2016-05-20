<p>
    SAGE is offering free access to its journals for the month of April 2016.
</p>
<p>
    To access the articles, you must create a (free) account at SAGE Journals Online. 
</p>
<div style="padding-left:1em; background:#F5F5F5;">
<p>
    <em>Need a SAGE account?</em>
</p>
<p>
    <a href="https://online.sagepub.com/cgi/register?registration=FTGlobal2016">Register for free now.</a>  
</p>
<p><em>Already have a SAGE account?</em></p>
<p><a  href="<?php echo $url; ?>">Continue to the article</a>.</p>
</div>
<div id="hide-message"><button id="hide-page">Don't show this page in the future</button></div>
<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = "expires="+d.toUTCString();
        document.cookie = "skipPage-<?php echo $pTitle; ?>=skip;" + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to the article</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        });
        
        });


    
</script>