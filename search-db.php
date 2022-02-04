<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
function findURL($arr, $query) {
	global $dbUrl;
    if ($query !== '') {
        return $arr['queryUrl'];
    }
    else {
        return $dbUrl;
    }  
}

$dbName = $_POST['db-name'];
$query = '';
if (isset($_POST['query'])) {
 $query = $_POST['query'];
 $query = urlencode($query);
}
$dbUrl = urldecode($_POST['db-url']);
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
$ezpStr = 'https://ezproxy.losrios.edu/login?url=';
$ebscoBase = $ezpStr . 'http://search.ebscohost.com/login.aspx?authtype=ip';
$dbs = array(
             array( // first array element is ehost patterns - treated differently
                'ehostcode' => $ehostCode,
                'queryUrl' => $ebscoBase . '&direct=true&db=' . $ehostCode . '&bquery=' .$query . '&site=ehost-live&scope=site'
             ),
													array(
														'dbname' => 'onesearch',
														'queryUrl' => 'https://caccl-lrccd.primo.exlibrisgroup.com/discovery/search?query=any,contains,' . $query . '&vid=01CACCL_LRCCD:' . $homeLibrary
													),
             array(
                'dbname' => 'ebook-collection',
                'queryUrl' => $ebscoBase . '&direct=true&db=nlebk&bquery=' . $query . '&profile=ebooks&site=ehost-live&scope=site'
             ),
            array(
                'dbname' => 'business-source',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&profile=bsc&site=bsc-live&scope=site'
             ),
            array(
                'dbname' => 'rehabilitation',
                'queryUrl' => $ebscoBase . '&direct=true&db=nrcn&db=rrc&bquery=' . $query .'&site=rrc-live&scope=site'
             ),
            array(
                'dbname' => 'explora',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&site=src_ic-live&scope=site'
             ),
												array(
                'dbname' => 'ebsco-search',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&profile=all&site=src_ic-live&scope=site'
             ),
												array(
															 'dbname' => 'artstor',
														  'queryUrl' => $ezpStr . 'http://library.artstor.org/#/search/' . $query
											  ),
             array(
																			'dbname' => 'cq-researcher',
																			'queryUrl' => $ezpStr . 'https://library.cqpress.com/cqresearcher/search.php?fulltext=' . $query . '&action=newsearch'
																			),
													array(
																			'dbname' => 'drama-online',
																			'queryUrl' => $ezpStr . 'https://www.dramaonlinelibrary.com/search-results?any=' . $query
																			),
													array(
                'dbname' => 'google',
                'queryUrl' => $ezpStr . 'https://scholar.google.com/scholar?hl=en&q=' .$query
             ),
             array(
                'dbname' => 'jstor',
                'queryUrl' => $ezpStr . 'http://www.jstor.org/action/doAdvancedSearch?q0=' .$query
             ),
             array(
                'dbname' => 'pubmed',
                'queryUrl' => $ezpStr . 'https://pubmed.ncbi.nlm.nih.gov/?term=' . $query . '&otool=casccllib'
             ),
             array(
																			'dbname' => 'gale-ebooks',
																			'queryUrl' => $ezpStr . 'https://go.galegroup.com/ps/i.do?dblist=GVRL&st=T003&qt=OQE~' .$query . '&sw=w&ty=bs&it=search&p=GVRL&s=RELEVANCE&u=' . $galeID . '&v=2.1'
																			),
													array(
																			'dbname' => 'literature-resource',
																			'queryUrl' => $ezpStr . 'https://go.gale.com/ps/basicSearch.do?inputFieldNames%5B0%5D=OQE&inputFieldValues%5B0%5D=' . $query . '&nwf=y&searchType=BasicSearchForm&userGroupName=' . $galeID .'&prodId=LitRC&spellCheck=true&method=doSearch'
																			),
														array(
																			'dbname' => 'debates-over',
																			'queryUrl' => $ezpStr . 'https://go.gale.com/ps/headerQuickSearch.do?inputFieldNames%5B0%5D=OQE&limiterTypes%5BDB%5D=OR&limiterFieldValues%5BDB%5D=allElectronicResources&limiterFieldValues%5BDB%5D=SAS-1&limiterFieldValues%5BDB%5D=SAS-3&quickSearchTerm=' . $query . '&searchType=BasicSearchForm&userGroupName=' . $galeID . '&nwf=y&prodId=SAS&stw.option=&ebook=&quicksearchIndex=OQE&spellCheck=true&hasCoProduct=false'
																			),
														array(
																			'dbname' => 'indigenous-peoples',
																			'queryUrl' => $ezpStr . 'https://go.gale.com/ps/headerQuickSearch.do?inputFieldNames%5B0%5D=OQE&limiterTypes%5BDB%5D=OR&limiterFieldValues%5BDB%5D=allElectronicResources&limiterFieldValues%5BDB%5D=SAS-1&limiterFieldValues%5BDB%5D=INDP-3&quickSearchTerm=' . $query . '&searchType=BasicSearchForm&userGroupName=' . $galeID . '&nwf=y&prodId=INDP&stw.option=&ebook=&quicksearchIndex=OQE&spellCheck=true&hasCoProduct=false'
																			),
														array(
																			'dbname' => 'institution-of',
																			'queryUrl' => $ezpStr . 'https://go.gale.com/ps/headerQuickSearch.do?inputFieldNames%5B0%5D=OQE&limiterTypes%5BDB%5D=OR&limiterFieldValues%5BDB%5D=allElectronicResources&limiterFieldValues%5BDB%5D=SAS-1&limiterFieldValues%5BDB%5D=SAS-3&quickSearchTerm=' . $query . '&searchType=BasicSearchForm&userGroupName=' . $galeID . '&nwf=y&prodId=SAS&stw.option=&ebook=&quicksearchIndex=OQE&spellCheck=true&hasCoProduct=false'
																			),
														array(
																			'dbname' => 'lgbtq-history',
																			'queryUrl' => $ezpStr . 'https://go.gale.com/ps/headerQuickSearch.do?inputFieldNames%5B0%5D=OQE&limiterTypes%5BDB%5D=OR&limiterFieldValues%5BDB%5D=allElectronicResources&limiterFieldValues%5BDB%5D=AHSI-1&quickSearchTerm=' . $query . '&searchType=BasicSearchForm&userGroupName=' . $galeID .'&nwf=y&prodId=AHSI&stw.option=&ebook=&quicksearchIndex=OQE&spellCheck=true&hasCoProduct=false'
																			),
             array(
                'dbname' => 'oxford-art',
                'queryUrl' => $ezpStr . 'http://www.oxfordartonline.com/groveart/search?siteToSearch=groveart&q=' . $query . '&searchBtn=Search&isQuickSearch=true'
             ),
             array(
                'dbname' => 'oxford-english',
                'queryUrl' => $ezpStr . 'http://www.oed.com/search?searchType=dictionary&q=' . $query
             ),
													array(
                'dbname' => 'ebook-central',
                'queryUrl' => $ezpStr . 'https://ebookcentral.proquest.com/lib/losrios/search.action?query=' . $query
             ),
             array(
                'dbname' => 'films',
                'queryUrl' => $ezpStr . 'https://digital.films.com/PortalPlaylists.aspx?wid=' .$fodWid .'&rd=a&q=' . $query
             ),
													array(
                'dbname' => 'bloom',
                'queryUrl' => $ezpStr . 'https://ebooks.infobase.com/PortalPlaylists.aspx?wid=' .$fodWid .'&rd=a&q=' . $query
             ),
             array(
                'dbname' => 'salem',
                'queryUrl' => $ezpStr . 'http://online.salempress.com/search.do?categoryName=&All=All&numCategories=5&searchInAll=all&searchText=' . $query
             ),
													array(
                'dbname' => 'access-world',
                'queryUrl' => $ezpStr . 'https://infoweb.newsbank.com/apps/news/results?p=AWNB&fld-base-0=alltext&val-base-0=' . $query
             ),
													array(
                'dbname' => 'chronicle',
                'queryUrl' => $ezpStr . 'https://www.chronicle.com/search?q=' .$query
             ),
													array(
																			'dbname'=>'heinonline',
																			'queryUrl'=>$ezpStr.'https://www.heinonline.org/HOL/LuceneSearch?terms='.$query.'&collection=all&searchtype=advanced&typea=text&tabfrom=&submit=Go&all=true'
													),
													array(
																'dbname' => 'sacramento',
																'queryUrl' => $ezpStr . 'https://infoweb.newsbank.com/apps/news/results?p=AWNB&fld-base-0=alltext&val-base-0=' . $query . '&t=family%3AA1963%21Sacramento%20Bee%20Collection'
												),
												array(
																'dbname' => 'sciencedirect',
																'queryUrl' => $ezpStr . 'https://www.sciencedirect.com/search/advanced?qs=' . $query
											 ),
												array(
															'dbname' => 'ovid',
															'queryUrl' => $ezpStr . 'http://ovidsp.ovid.com/ovidweb.cgi?T=JS&CSC=y&PAGE=main&NEWS=n&DBC=n&D=yrovft&SEARCH=' . $query
												),
			
           array(
              'dbname' => 'naxos',
              'queryUrl' => $ezpStr . 'http://losrios.naxosmusiclibrary.com/google/searchgoogle.asp?googletext=' . $query
           ),
											array(
													'dbname' => 'wiley',
													'queryUrl' => $ezpStr . 'https://www.onlinelibrary.wiley.com/action/doSearch?AllField=' . $query		. '&PubType=journal'			
											),
											array(
												'dbname' => 'sage',
												'queryUrl' => $ezpStr . 'https://journals.sagepub.com/action/doSearch?AllField=' . $query			
											),
										 array(
												'dbname' => 'black-thought',
												'queryUrl' => 'https://search.alexanderstreet.com/bltc/search?searchstring=' . $query
																	),
											array(
												'dbname' => 'north-american',
												'queryUrl' => 'https://search.alexanderstreet.com/ibio/search?searchstring=' . $query
											),
											array(
												'dbname' => 'primary-source',
												'queryUrl' => 'https://go.gale.com/ps/i.do?action=interpret&ty=bs&v=2.1&u=sacr28903&it=search&p=GDCS&qt=OQE~' . $query . '&sw=w'
																	)
         );


if ($ehostCode !== '') {
    $url = findURL($dbs[0], $query);
}
else {
    for ($i = 1; $i < count($dbs); $i++) { // loop starts with second array element
        if (strpos($dbName, $dbs[$i]['dbname']) > -1) {
            $url = findURL($dbs[$i], $query);
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
var messageBlock = document.getElementById('message');
setInterval(function() {
    var newText = sampleMessages[i++ % sampleMessages.length];
	messageBlock.innerHTML = '';
	setTimeout(function() {
		messageBlock.innerHTML = newText;
	}, 100);
	
	
}, 1 * 4000);
</script>
<?php
}
?>


</body>
</html>