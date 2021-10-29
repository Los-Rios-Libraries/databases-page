<div class="container">
<div id="aside-area">
<?php
if (isset($json_file)) {
if ((!isset($category)) && (empty($alpha)) ) {
  ?>
<aside id="chat-widget" class="gen-aside mb-3">
  <div id="libchat_<?php echo $chatWidget; ?>"></div>
  <script src="https://answers.library.losrios.edu/load_chat.php?hash=<?php echo $chatWidget; ?>"></script>
</aside>
  <?php
if (strpos($json_file, 'trial') > -1) {
?>
<aside id="trial-dbs" class="gen-aside mb-2">
  <div class="lr-secondary p-1">
	<h2 >Trial Databases</h2>
	<?php
	trialDbs();
	?>
  </div>
</aside>
<?php
}
}
}

?>
<?php
if (strpos($_SERVER['REMOTE_ADDR'], '165.196.') === false)
{
?>
<aside class="gen-aside proxy-button mb-3">
	You are currently signed <span id="proxy-status">out</span>.
	<button id="proxy-toggle" class="btn btn-sm btn-secondary">Sign in</button>
</aside>
<?php
}

?>

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
	echo '<aside class="gen-aside proxy-button mb-3">';
	if ($ezAuth !== '2') {
		echo '<button id="force-login" type="button" class="btn btn-sm btn-link text-left">Force login while on-campus</button>';
	}
	else {
		echo '<button id="reset-login" type="button" class="btn btn-sm btn-outline-secondary">Stop forcing login on this computer</button>';
	}
	echo '</aside>' . "\r\n";
}
echo '<aside class="gen-aside proxy-button mb-3" id="sso" ' . $noSSO . '>';
echo '<button type="button" id="disable-sso" class="btn btn-sm btn-link text-left" >Bypass single sign-on</button>';
echo '</aside>' . "\r\n";
?>
<aside id="proxy" class="gen-aside proxy-button mb-3">
  <button id="remove-proxy" type="button" class="btn btn-sm btn-link text-left">Remove proxy (for troubleshooting access problems)</button>
</aside>
</div>


</div>