<aside id="new-windows">
  <form><input type="checkbox" id="newwin-check"> <label for="newwin-check">Open links in new windows</label></form>
</aside>
<?php
if (isset($json_file)) {
if ((!isset($category)) && (empty($alpha)) ) {
if (strpos($json_file, 'trial') > -1) {
?>
<aside id="trial-dbs" class="gen-aside">
	<h2>Trial Databases</h2>
	<?php
	trialDbs();
	?>
	
</aside>

<?php
}
}
}
if (strpos($_SERVER['REMOTE_ADDR'], '165.196.') === false)
{
?>
<aside class="gen-aside proxy-button">
	You are currently signed <span id="proxy-status">out</span>.
	<button id="proxy-toggle">Sign in</button>
</aside>
<?php
}

echo "<aside id=\"library-help\" class=\"gen-aside\">\n";
if ($homeLibrary === 'unknown') {
  echo "<h2>From Your Library</h2>\n";
}
else {
  echo '<h2>From the ' . strtoupper($homeLibrary) . ' Library</h2>';
}
echo "<div class=\"hidden\">" . $homeLibrary . "</div>\n";
echo "<div id=\"library-help-content\">\n";
include_once('help/' . $homeLibrary . '.php');
// echo 'home library is '.$homeLibrary;
// include('help/' .$homeLibrary . '.php');

echo "</div>\n";
?>
<hr>
<div id="choose-library">
	<button type="button"><abbr title="American River College">arc</abbr></button> <button type="button"><abbr title="Cosumnes River College">crc</abbr></button> <button type="button"><abbr title="Folsom Lake College">flc</abbr></button> <button type="button"><abbr title="Sacramento City College">scc</abbr></button>
</div>
</aside>

<aside id="ga-notice" class="gen-aside">
  <p class="special">The Library uses Google Analytics to track activity on this site. <span id="ga-status"><a target="blank" id="ga-opt-out" href="../notes/google-analytics.php">Read more &amp; opt out.</a></span></p>
</aside>

<aside id="proxy" class="gen-aside proxy-button">
  <button id="remove-proxy" type="button">Remove proxy (for troubleshooting access problems)</button>
</aside>
<?php
$noSSO = '';
$dbProxy = '';
if (isset($_COOKIE['dbProxy'])) {
  $dbProxy = $_COOKIE['dbProxy'];
}
$ezAuth = '';
if (isset($_COOKIE['ezproxyrequireauthenticate2'])) {
  $ezAuth = $_COOKIE['ezproxyrequireauthenticate2'];
}
//if ((strpos($_SERVER['REMOTE_ADDR'], '165.196.') !== false) && ($_COOKIE['dbProxy'] !== 'removed')) {
if ((preg_match('/^(165\.196\.|10\.|172\.)/', $_SERVER['REMOTE_ADDR']) === 1) && ($dbProxy !== 'removed')) {
	$noSSO = 'style="display:none;"';
	echo '<aside class="gen-aside proxy-button">';
	if ($ezAuth !== '2') {
		echo '<button id="force-login" type="button">Force login while on-campus</button>';
	}
	else {
		echo '<button id="reset-login" type="button">Stop forcing login on this computer</button>';
	}
	echo '</aside>' . "\r\n";
}
echo '<aside class="gen-aside proxy-button" id="sso" ' . $noSSO . '>';
echo '<button type="button" id="disable-sso">Bypass single sign-on</button>';
echo '</aside>' . "\r\n";
?>