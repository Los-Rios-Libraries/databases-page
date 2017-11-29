<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
function findURL($arr, $query) {
    if ($query !== '') {
        return $arr['queryUrl'];
    }
    else {
        return $arr['noquery'];
    }  
}

$dbName = $_POST['db-name'];
$query = '';
if (isset($_POST['query'])) {
 $query = $_POST['query'];
 $query = urlencode($query);
}
$vendor = $_POST['vendor'];
$ehostCode = '';
if (isset($_POST['ehost'])) {
$ehostCode = $_POST['ehost'];
}
$url = '';
$homeLibrary = '';
$galeID = '';
$fodWid = '';
if (isset($_COOKIE['homeLibrary'])) {
$homeLibrary = $_COOKIE['homeLibrary'];
}
$collegeVars = array(
  array(
    'homeLib' => 'arc',
    'galeID' => 'sacr22807',
    'fodWid' => '240535'
    ),
  array(
    'homeLib' => 'crc',
    'galeID' => 'sacr73031',
    'fodWid' => '237206'
    ),
  array(
    'homeLib' => 'flc',
    'galeID' => 'sacr88293',
    'fodWid' => '237742'
    ),
  array(
    'homeLib' => 'scc',
    'galeID' => 'cclc_sac',
    'fodWid' => '106093'
    )
);

for ($i = 0; $i < count($collegeVars); $i++) {
    if ($homeLibrary === $collegeVars[$i]['homeLib']) {
        $galeID = $collegeVars[$i]['galeID'];
        $fodWid = $collegeVars[$i]['fodWid'];
        
    }
}
$proxyStr = '.lasiii.losrios.edu/';
$ebscoBase = 'http://0-search.ebscohost.com' . $proxyStr .'login.aspx?authtype=ip';
$dbs = array(
             array( // first array element is ehost patterns - treated differently
                'vendor' => 'ebsco',
                'ehostcode' => $ehostCode,
                'noquery' => $ebscoBase . '&profile=ehost&defaultdb=' . $ehostCode,
                'queryUrl' => $ebscoBase . '&direct=true&db=' . $ehostCode . '&bquery=' .$query . '&site=ehost-live&scope=site'
             ),
             array(
                'vendor' => 'ebsco',
                'dbname' => 'onesearch',
                'noquery' => $ebscoBase . '&profile=eds',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query . '&profile=eds&site=eds-live&scope=site'
             ),
             array(
                'vendor' => 'ebsco',
                'dbname' => 'ebook',
                'noquery' => $ebscoBase . '&profile=eds&defaultdb=nlebk',
                'queryUrl' => $ebscoBase . '&direct=true&db=nlebk&bquery=' . $query . '&profile=ebooks&site=ehost-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'small',
                'noquery' => $ebscoBase . '&profile=sbrc',
                'queryUrl' =>'&direct=true&profile=sbrc&bquery=' . $query .'&site=sbrc-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'business source',
                'noquery' => $ebscoBase . '&profile=bsc',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&profile=bsc&site=bsc-live&scope=site'
             ),
            
            array(
                'vendor' => 'ebsco',
                'dbname' => 'literary',
                'noquery' => $ebscoBase . '&profile=plus',
                'queryUrl' => $ebscoBase . '&direct=true&db=lkh&bquery=' . $query .'&site=lrc-plus&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'rehabilitation',
                'noquery' =>  $ebscoBase . '&profile=rrc',
                'queryUrl' => $ebscoBase . '&direct=true&db=nrcn&db=rrc&bquery=' . $query .'&site=rrc-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'consumer',
                'noquery' =>  $ebscoBase . '&profile=chc',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&site=chc-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'explora',
                'noquery' =>  $ebscoBase . '&profile=src_ic',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&site=src_ic-live&scope=site'
             ),
             array(
                'vendor' => 'google',
                'dbname' => 'google',
                'noquery' =>  'http://0-scholar.google.com'. $proxyStr,
                'queryUrl' => 'http://0-scholar.google.com'. $proxyStr . 'scholar?hl=en&q=' .$query
             ),
             array(
                'vendor' => 'jstor',
                'dbname' => 'jstor',
                'noquery' =>  'http://0-www.jstor.org'. $proxyStr . 'action/showAdvancedSearch',
                'queryUrl' => 'http://0-www.jstor.org'. $proxyStr . 'action/doAdvancedSearch?q0=' .$query
             ),
             array(
                'vendor' => 'pubmed',
                'dbname' => 'pubmed',
                'noquery' =>  'http://0-www.ncbi.nlm.nih.gov'. $proxyStr . 'pubmed?myncbishare=casccllib',
                'queryUrl' => 'http://0-www.ncbi.nlm.nih.gov'. $proxyStr . 'pubmed?/?term=' . $query . '&myncbishare=casccllib'
             ),
             array(
                'vendor' => 'gale',
                'dbname' => 'gale-virtual',
                'noquery' =>  'http://0-infotrac.galegroup.com'. $proxyStr . 'itweb?db=GVRL',
                'queryUrl' => 'http://0-go.galegroup.com'. $proxyStr . 'ps/i.do?dblist=GVRL&st=T003&qt=OQE~' .$query . '&sw=w&ty=bs&it=search&p=GVRL&s=RELEVANCE&u=' . $galeID . '&v=2.1'
             ),
             array(
                'vendor' => 'american',
                'dbname' => 'acls-humanities',
                'noquery' =>  'http://0-quod.lib.umich.edu'. $proxyStr . 'cgi/t/text/text-idx?c=acls;rgn=full%20text;page=simple',
                'queryUrl' => 'http://0-quod.lib.umich.edu'. $proxyStr . 'cgi/t/text/text-idx?c=acls&cc=acls&op2=and&rgn2=series&sort=freq&type=simple&q1=' . $query .'&rgn1=full+text&q2=ACLS+Humanities+E-Book&cite1=&cite1restrict=author&cite2=&cite2restrict=author&Submit=Search'
             ),
             array(
                'vendor' => 'oxford',
                'dbname' => 'oxford-art',
                'noquery' =>  'http://0-www.oxfordartonline.com'. $proxyStr,
                'queryUrl' => 'http://0-www.oxfordartonline.com'. $proxyStr . 'subscriber/search_results?q=' . $query
             ),
             array(
                'vendor' => 'oxford',
                'dbname' => 'oxford-english',
                'noquery' =>  'http://0-www.oed.com'. $proxyStr,
                'queryUrl' => 'http://0-www.oed.com'. $proxyStr . 'search?searchType=dictionary&q=' . $query
             ),
             array(
                'vendor' => 'infobase',
                'dbname' => 'films',
                'noquery' =>  'http://0-digital.films.com'. $proxyStr . 'PortalPlaylists.aspx?wid=' .$fodWid,
                'queryUrl' => 'http://0-digital.films.com'. $proxyStr . 'PortalPlaylists.aspx?wid=' .$fodWid .'&rd=a&q=' . $query
             ),
             array(
                'vendor' => 'proquest',
                'dbname' => 'resources',
                'noquery' =>  'http://0-www.rclweb.net'. $proxyStr,
                'queryUrl' => 'http://0-www.rclweb.net'. $proxyStr . 'Search/Results?q=rcl-searchall%3A[' . $query . ']&op=1&qs=1'
             ),
             array(
                'vendor' => 'salem',
                'dbname' => 'salem',
                'noquery' =>  'http://0-online.salempress.com'. $proxyStr . 'home.do',
                'queryUrl' => 'http://0-online.salempress.com'. $proxyStr . 'search.do?categoryName=&All=All&numCategories=5&searchInAll=all&searchText=' . $query
             ),
             array(
                'vendor' => 'naxos',
                'dbname' => 'naxos',
                'noquery' =>  'http://0-losrios.naxosmusiclibrary.com'. $proxyStr,
                'queryUrl' => 'http://0-losrios.naxosmusiclibrary.com'. $proxyStr . 'google/searchgoogle.asp?googletext=' . $query
             )
             
             );


if ($ehostCode !== '') {
    $url = findURL($dbs[0], $query);
    echo 'url is ' .$url;
}
else {
    for ($i = 1; $i < count($dbs); $i++) { // loop starts with second array element
        if (strpos($dbName, $dbs[$i]['dbname']) > -1) {
            $url = findURL($dbs[$i], $query);
            echo $url;
            break;
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<meta charset="utf-8" >
<meta name="robots" description="noindex">
 <meta name=viewport content="width=device-width, initial-scale=1">
<title>Finding Database</title>

<link rel="stylesheet" href="style.css" >



</head>
<body>
    <div id="message">Loading database...</div>
    <img id="loader" alt="loading" src="loader.gif">
<?php
if ($url !== '') {

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
location.replace('<?php echo $url; ?>');
// http://stackoverflow.com/a/12135342/1903000
var i = 1;
var sampleMessages = [ "Loading database...", "Still loading...", "Still loading..." ];
setInterval(function() {
    var newText = sampleMessages[i++ % sampleMessages.length];
    $("#message").fadeOut(600, function () {
      $(this).text(newText).fadeIn(500);
    });
}, 1 * 4000);
</script>
<?php
}
?>


</body>
</html>