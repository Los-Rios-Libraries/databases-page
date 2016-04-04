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

elseif (strpos($vendor, 'american') > -1) {
    $urlBase = 'http://0-quod.lib.umich.edu.lasiii.losrios.edu/cgi/t/text/text-idx?c=acls';
    if ($query !== '') {
    $url = $urlBase . '&cc=acls&op2=and&rgn2=series&sort=freq&type=simple&q1=' . $query .'&rgn1=full+text&q2=ACLS+Humanities+E-Book&cite1=&cite1restrict=author&cite2=&cite2restrict=author&Submit=Search';
}
else {
    $url = $urlBase . ';rgn=full%20text;page=simple';
}

}
elseif (strpos($dbName, 'oxford') > -1) {
    $urlBase = 'http://0-www.oed.com.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'search?searchType=dictionary&q=' . $query;
    }
    else {
        $url = $urlBase;
    }
    
}
elseif (strpos($dbName, 'grove') > -1) {
    $urlBase = 'http://0-www.oxfordartonline.com.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'subscriber/search_results?q=' . $query;
    }
    else {
        $url = $urlBase;
    }
    
}
elseif (strpos($dbName, 'r2') > -1) {
    $urlBase = 'http://0-www.r2library.com.lasiii.losrios.edu/';
    if ($query !== '') {
    $url = $urlBase . 'Search?q=' . $query . '#include=1';
    }
    else {
        $url = $urlBase . '/Browse#include=1&type=disciplines';
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
    $jazz = '';
    $remainderNax = 'google/searchgoogle.asp?googletext=' . $query;
    if (strpos($dbName, 'jazz') > -1) {
        $jazz = 'jazz/';
    }
    elseif (strpos($dbName, 'world') > -1) {
        $jazz = 'world/';
    }
    if ($query !== '') {
    $url = $urlBase . $jazz . $remainderNax;
    }
    else {
        $url = $urlBase . $jazz;
    }
    }
elseif (strpos($vendor, 'conquest') > -1) {
    if (strpos($dbName, 'ready') > -1) {

    $urlBase = 'http://0-readyreference.data-planet.com.lasiii.losrios.edu/dataplanet/';
    
    }
    if ($query !== '') {
    $url = $urlBase . 'result-list/collections:DP-DATAPLANET/fullRecord:' . $query . '/';
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