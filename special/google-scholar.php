<p>
    Google Scholar is currently not showing links to the research databases. Our vendor is working to fix this problem.</p> <p>You can use Google Scholar, but we highly recommend using OneSearch or other databases in order to find full-text articles.
</p>
<p>
  <a  href="<?php echo $url; ?>">Continue to Google Scholar</a>.</p>

<div id="hide-message"><button id="hide-page">Don't show this page in the future</button></div>
</div>
<script>
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = "expires="+d.toUTCString();
        document.cookie = "skipPage-<?php echo $pTitle; ?>=skip;" + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').hide().html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to Google Scholar</a>');
        $('#hide-message').html(result);
        result.fadeIn();
        });
        
        });
    var ntTitle = document.getElementById('title-alpha');
    ntTitle.innerHTML = ntTitle.innerHTML.replace('tools', 'Tools');
</script>