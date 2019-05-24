<?php
$url = $_GET['url'];
?>
<style>
   .special h2 {background:transparent; color:#0f0f0f; font-weight:bold;}
   .special ol {background:transparent; padding-top:0;}
   #hide-message {text-align:right;}
</style>
<div class="special">
<p><strong>Access to Nexis Uni will expire on June 30, 2019.</strong></p>
<p>In the future, you may use alternative strategies to find content normally found in Nexis Uni.
</p>
<h2>State and Federal Cases</h2>
<p>You may find state and federal court decisions using <strong>Google Scholar</strong>.</p>
<ol>
    <li>Visit <a href="index.php?az&amp;query=google%20scholar">Google Scholar</a>.</li>
   <li>Select the <strong>Case law</strong> radio button underneath the search box.</li>
</ol>
<h2>Law Reviews</h2>
<p><strong>OneSearch</strong> contains a large number of legal journal articles from various sources. Try adding the phrase &quot;law review&quot; to your search.</p>
<h2>Newspapers and other news sources</h2>
<p>The Library will be adding two databases, <strong>US Major Dailies</strong> and <strong><a href="index.php?az&amp;query=newsbank">Access World News</a></strong>, to replace the news sources in Nexis Uni. In addition, OneSearch features a News source type limiter that can be used to search for news content.</p>
<h2>Business Profiles</h2>
<p><strong><a href="index.php?az&amp;query=business+source+complete">Business Source Complete</a></strong> contains profiles of businesses similar to those found in Nexis Uni.</p>
<p><a class="db-name" href="<?php echo $url; ?>">Continue to Nexis Uni.</a></p>
<div id="hide-message"><button id="hide-page">In the future, go directly to Nexis Uni</button></div>
</div>
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
