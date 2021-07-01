<div id="db-display">

<?php

if ($_GET['db'] === 'kanopy') {
	if (isset($_COOKIE['skipPage-kanopy'])) {
		if ($_COOKIE['skipPage-kanopy'] === 'skip') {
			?>
			<script>
				location.href = 'https://losrios.kanopy.com/';
			</script>
			
			<?php
			exit;
		}
	}
	else {
	?>
<h2>Kanopy</h2>
<div class="shadow-sm p-2 mb-1 bg-white border-0 rounded">
	<p>
   <em>Note:</em> When you visit Kanopy, you will see some buttons that say <em>Log in to Los Rios</em> and others that just say <em>Log in</em>.
</p>
<p>
   It is important that you only click the buttons that say <em>Log in to Los Rios</em>. The other buttons are for personal Kanopy accounts. These are needed for Kanopy apps used on mobile devices, Roku, and Apple TV. A personal account <strong>is not needed</strong> for viewing Kanopy on a desktop or laptop computer.
</p>
<p><strong>Faculty:</strong> if you need a Kanopy video we do not have access to, please fill out the request form on the video&apos;s page, and specify the reason you need it. We will fill requests as funding allows.</p>
<p>During Summer Recess and Summer Session, the requests will not be monitored.</p>
<p><a href="https://losrios.kanopy.com/" class="db-name btn btn-outline-primary">Continue to Kanopy</a></p>
<div id="hide-message" class="text-right"><button class="btn btn-secondary" id="hide-page">In the future, go directly to Kanopy</button></div>
</div>

<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = 'expires='+d.toUTCString();
        document.cookie = 'skipPage-kanopy=skip;' + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a class="db-name" href="https://losrios.kanopy.com/">Continue to Kanopy</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        
        });
        
        });


    
</script>
	
	<?php
	}
}
if ($_GET['db'] === 'dtplus') {
	if (isset($_COOKIE['skipPage-dtplus'])) {
		if ($_COOKIE['skipPage-dtplus'] === 'skip') {
			?>
			<script>
				location.href = 'https://ezproxy.losrios.edu/login?url=https://edu.digitaltheatreplus.com/';
			</script>
			
			<?php
			exit;
		}
	}
	else {
	?>
<h2>Digital Theatre Plus</h2>
<div class="shadow-sm p-2 mb-1 bg-white border-0 rounded">
	<p>
   This vendor is having some problems with its new platform. If you are experiencing problems, please use a <a href="https://docs.google.com/document/d/1ImtNPBM-exYsi5w9Q5kYoGJ86jw_p85d9qwVfMaz-MI/edit?usp=sharing">username and password that you will find on a shared Google document</a>. To access this document, you need to sign in using your campus credentials (for example, w1234567@apps.losrios.edu)
</p>
<p><a href="https://ezproxy.losrios.edu/login?url=https://edu.digitaltheatreplus.com/" class="db-name btn btn-outline-primary">Continue to Digital Theatre Plus without username/password</a></p>
<div id="hide-message" class="text-right"><button class="btn btn-secondary" id="hide-page">In the future, go directly to Digital Theatre Plus</button></div>
</div>

<script>
    
    document.getElementById('hide-page').addEventListener('click', function() {
        var d = new Date();
    d.setTime(d.getTime() + (2592000000));
    var expires = 'expires='+d.toUTCString();
        document.cookie = 'skipPage-dtplus=skip;' + expires;
        jQuery(document).ready(function($){
        var result = $('<p />').attr('style', 'display:none;').html('OK! In the future you will bypass this page. <a class="db-name" href="https://ezproxy.losrios.edu/login?url=https://edu.digitaltheatreplus.com/">Continue to Digital Theatre Plus</a>');
        
        $('#hide-message').html(result);
        result.fadeIn();
        
        });
        
        });


    
</script>
	
	<?php
	}
}

elseif ($_GET['db'] === 'films-on-demand') {
	if ($college !== 'unknown') {
		$wids = array(
                'arc' =>'240535',
                'crc' =>'237206',
                'flc' => '237742',
                'scc' =>'106093'
                
                );
		$wID;
		foreach ($wids as $key => $value) {
			if ($key === $college) {
				$wID = $value;
				}
			}
  
  ?>
  
  <script>
    location.href = 'https://ezproxy.losrios.edu/login?url=https://fod.infobase.com/PortalPlayLists.aspx?wid=<?php echo $wID; ?>';
  </script>
<?php
	}
else {
	?>
	<h2>Films on Demand</h2>
	<p>Please select your college:</p>
    <ul>
      <li><a href="https://ezproxy.losrios.edu/login?url=http://fod.infobase.com/PortalPlayLists.aspx?wid=240535" onclick="setCookie('homeLibrary', 'arc', 10);">American River College</a></li>
      <li><a href="https://ezproxy.losrios.edu/login?url=http://fod.infobase.com/PortalPlayLists.aspx?wid=237206" onclick="setCookie('homeLibrary', 'crc', 10);">Cosumnes River College</a></li>
      <li><a href="https://ezproxy.losrios.edu/login?url=http://fod.infobase.com/PortalPlayLists.aspx?wid=237742" onclick="setCookie('homeLibrary', 'flc', 10);">Folsom Lake College</a></li>
      <li><a href="https://ezproxy.losrios.edu/login?url=http://fod.infobase.com/PortalPlayLists.aspx?wid=106093" onclick="setCookie('homeLibrary', 'scc', 10);">Sacramento City College</a></li>
    </ul>
	<?php
}
}

?>
</div>