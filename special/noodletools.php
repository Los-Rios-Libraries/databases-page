<p>
    NoodleTools is a research management tool that helps you organize your research and cite your sources in MLA, APA, and Chicago Style. It also offers the ability to take notes and create outlines. 
</p>
<p>
    To access NoodleTools, you must first register. To do so:
</p>
<ol>
<li> Go to the <a href="https://my.noodletools.com/logon/signin?group=21577&code=9928">special registration page</a> and enter the following credentials:
<ul><li>User name: <strong>trial11450</strong></li>
<li>Password: <strong>vipa2meme</strong></li></ul>
</li>
<li>
    After signing in, you will be prompted to create a personal account. This is the login information you will use in the future.
</li>
</ol>
<div style="padding-left:1em; background:#F5F5F5;">

<p><em>Already registered?</em></p>
<p><a  href="<?php echo $url; ?>">Continue to NoodleTools</a>.</p>
</div>
<div id="hide-message"><button id="hide-page">Don't show this page in the future</button></div>

<script>
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = "expires="+d.toUTCString();
        document.cookie = "skipPage-<?php echo $pTitle; ?>=skip;" + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').hide().html('OK! In the future you will bypass this page. <a href="<?php echo $url; ?>">Continue to NoodleTools</a>');
        $('#hide-message').html(result);
        result.fadeIn();
        });
        
        });
    var ntTitle = document.getElementById('title-alpha');
    ntTitle.innerHTML = ntTitle.innerHTML.replace('tools', 'Tools');
</script>