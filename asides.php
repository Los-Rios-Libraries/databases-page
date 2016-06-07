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
echo "<aside id=\"library-help\" class=\"gen-aside\">\n";
echo "<h2>From Your Library</h2>\n";
echo "<div class=\"hidden\">" . $homeLibrary . "</div>\n";
echo "<div id=\"library-help-content\">\n";

// echo 'home library is '.$homeLibrary;
// include('help/' .$homeLibrary . '.php');

echo "</div>\n";
?>
<hr>
<div id="choose-library">
	<button><abbr title="American River College">arc</abbr></button> <button><abbr title="Cosumnes River College">crc</abbr></button> <button><abbr title="Folsom Lake College">flc</abbr></button> <button><abbr title="Sacramento City College">scc</abbr></button>
</div>
</aside>