<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
$dbName = $_POST['db-name'];
 $query = $_POST['query'];
 $query = urlencode($query);
$vendor = $_POST['vendor'];
$ehostCode = $_POST['ehost'];
$url = '';
$ebscoBase = 'http://0-search.ebscohost.com.lasiii.losrios.edu/login.aspx?authtype=ip';
if ($vendor === 'ebsco') {
    if (isset($ehostCode)) {
        if ($query!== ''){
    $ebscoRemainder = '&direct=true&db=' . $ehostCode . '&bquery=' .$query . '&site=ehost-live&scope=site';
    $url = $ebscoBase . $ebscoRemainder;
        }
        else {
            $url = $ebscoBase . '&profile=ehost&defaultdb=' . $ehostCode;
            
        }
    }
    elseif (strpos($dbName, 'onesearch') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&bquery=' . $query . '&profile=eds&site=eds-live&scope=site';
        }
        else {
            $url = $ebscoBase . '&profile=eds';
        }
    }
    elseif (strpos($dbName,'ebook') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&db=nlebk&bquery=' . $query . '&profile=ebooks&site=ehost-live&scope=site';
        }
        else {
            $url = $ebscoBase . '&profile=eds&defaultdb=nlebk';
        }
    }
    elseif (strpos($dbName, 'business') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&db=bth&bquery=' . $query .'&site=bsi-live&scope=site';
        }
        else {
        $url = $ebscoBase . '&profile=bsc';
        }
    }
    elseif (strpos($dbName, 'literary') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&db=lkh&bquery=' . $query .'&site=lrc-plus&scope=site';
        }
        else {
            $url = $ebscoBase . '&profile=plus';
        }
    }
       elseif (strpos($dbName, 'rehabilitation') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&db=nrcn&db=rrc&bquery=' . $query .'&site=rrc-live&scope=site';
        }
        else {
            $url = $ebscoBase . '&profile=rrc';
        }
    }
    elseif(strpos($dbName, 'consumer') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&bquery=' . $query .'&site=chc-live&scope=site';
        }
        else {
            $url = $ebscoBase . '&profile=chc';
        }
    }
        elseif(strpos($dbName, 'explora') > -1) {
        if ($query !== '') {
        $url = $ebscoBase . '&direct=true&bquery=' . $query .'&site=src_ic-live&scope=site';
        }
        else {
            $url = $ebscoBase . '&profile=src_ic';
        }
    }
}
elseif (strpos($vendor, 'cq') > -1) {
    $urlBase = 'http://0-library.cqpress.com.lasiii.losrios.edu/cqresearcher/';
    if ($query !== '') {
    $url = $urlBase . 'cqresearcher/search.php?fulltext=' .$query .' &action=newsearch&sort=custom%3Asorthitsrank%2Cd&x=0&y=0';
    }
    else {
        $url = $urlBase;
    }
}
elseif (strpos($vendor, 'google') > -1) {
    $urlBase = 'http://0-scholar.google.com.lasiii.losrios.edu/';
    if ($query !== '') {
        $url = $urlBase . 'scholar?hl=en&q=' .$query;
    }
    else {
        $url = $urlBase;
    }
}
elseif (strpos($vendor, 'jstor') > -1) {
    $urlBase = 'http://0-www.jstor.org.lasiii.losrios.edu/action/';
    if ($query !== '') {
        $url = $urlBase . 'doAdvancedSearch?q0=' .$query;
        }
    else {
        $url = $urlBase . 'showAdvancedSearch';
    }
}
elseif (strpos($dbName, 'pubmed') > -1) {
    $urlBase = 'http://0-www.ncbi.nlm.nih.gov.lasiii.losrios.edu/pubmed';
    if ($query !== '') {
    $url = $urlBase . '/?term=' . $query . '&myncbishare=casccllib';
    }
    else {
        $url = $urlBase . '?myncbishare=casccllib';
    }
}
elseif (strpos($dbName, 'gale-virtual') > -1) {
    $urlBase = 'http://0-go.galegroup.com.lasiii.losrios.edu';
    if ($query !== '') {
        $homeLibrary = $_COOKIE['homeLibrary'];
        switch ($homeLibrary) {
            case 'arc':
                $galeID = 'sacr22807';
                break;
            case 'scc':
                $galeID = 'cclc_sac';
                break;
            case 'crc':
                $galeID = 'sacr73031';
                break;
            case 'flc':
                $galeID = 'sacr88293';
                break;
            default:
                $galeID = 'sacr28903';
            }
        $url = $urlBase . '/ps/i.do?dblist=GVRL&st=T003&qt=OQE~' .$query . '&sw=w&ty=bs&it=search&p=GVRL&s=RELEVANCE&u=' . $galeID . '&v=2.1';
    }
    else {
        $url = 'http://0-infotrac.galegroup.com.lasiii.losrios.edu/itweb?db=GVRL';
    }
}
elseif (strpos($vendor, 'american') > -1) {
    $urlBase = 'http://0-quod.lib.umich.edu.lasiii.losrios.edu/cgi/t/text/text-idx?c=acls';
    if ($query !== '') {
    $url = $urlBase . '&cc=acls&op2=and&rgn2=series&sort=freq&type=simple&q1=' . $query .'&rgn1=full+text&q2=ACLS+Humanities+E-Book&cite1=&cite1restrict=author&cite2=&cite2restrict=author&Submit=Search';
}
else {
    $url = $urlBase . ';rgn=full%20text;page=simple';
}

}
elseif (strpos($dbName, 'oxford-english') > -1) {
    $urlBase = 'http://0-www.oed.com.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'search?searchType=dictionary&q=' . $query;
    }
    else {
        $url = $urlBase;
    }
    
}
elseif (strpos($dbName, 'oxford-art') > -1) {
    $urlBase = 'http://0-www.oxfordartonline.com.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'subscriber/search_results?q=' . $query;
    }
    else {
        $url = $urlBase;
    }
    
}
elseif (strpos($dbName, 'uptodate') > -1) {
    $urlBase = 'https://0-www-uptodate-com.lasiii.losrios.edu/';
    if ($query !== '') {
        $url = $urlBase . 'contents/search?search=' . $query . '&sp=&searchType=PLAIN_TEXT&source=USER_INPUT&searchControl=TOP_PULLDOWN&searchOffset=1&autoComplete&language=&max=0';
    }
    else {
        $url = $urlBase;
    }
}
  elseif (strpos($dbName, 'resources') > -1) {
    $urlBase = 'http://0-www.rclweb.net.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'Search/Results?q=rcl-searchall%3A[' . $query . ']&op=1&qs=1';
    }
    else {
        $url = $urlBase;
    }
    
}
elseif (strpos($dbName, 'films') > -1) {
    $homeLibrary = $_COOKIE['homeLibrary'];
    switch ($homeLibrary) {
        case 'arc':
        $wID = '240535';
        break;
      case 'scc':
        $wID = '106093';
        break;
      case 'crc':
        $wID = '237206';
        break;
      case 'flc':
        $wID = '237742';
        break;
      default:
       $wID = '107590'; 
  }
    $urlBase = 'http://0-digital.films.com.lasiii.losrios.edu/PortalPlaylists.aspx?wid=' .$wID;
    if ($query !== '') {
    $url = $urlBase . '&rd=a&q=' . $query;
//    echo $url;
//    exit;
    }
    else {
        $url = $urlBase;
    }
    
}
elseif (strpos($vendor, 'salem') > -1) {

    $urlBase = 'http://0-online.salempress.com.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'search.do?categoryName=&All=All&numCategories=5&searchInAll=all&searchText=' . $query;
    }
    else {
        $url = $urlBase . 'home.do';
    }
}

elseif (strpos($vendor, 'naxos') > -1) {
    $urlBase = 'http://0-losrios.naxosmusiclibrary.com.lasiii.losrios.edu/';
    $remainderNax = 'google/searchgoogle.asp?googletext=' . $query;
    if ($query !== '') {
    $url = $urlBase .  $remainderNax;
    }
    else {
        $url = $urlBase;
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

 

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


</head>
<body>
    <div id="message">Loading database...</div>
    <img id="loader" alt="loading" src="loader.gif">
<?php
if ($url !== '') {

?>
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