<?php
$query = $_POST['find'];
$query = strtolower($query);
// $resource = $_POST['search-type'];
/*
switch ($resource){
case 'onesearch':
    $url = 'http://0-search.ebscohost.com.lasiii.losrios.edu/login.aspx?authtype=ip&groupid=main&profile=eds&direct=true&site=eds-live&bquery=' . urlencode($query);
    break;
    
case 'dbpage':
    $url = 'index.php?az&query=' .urlencode($query);
    break;


    }
    */
$dbQuery = '/ebsco$|proquest|academic search complete|films on demand|cinahl|j( )?stor|lex[ui]s(( )?nex[iu]s)?|gale virtual|gvrl|cq|onesearch|oxford art|^grove|artstor|ebooks|google scholar|business source|statista|opposing viewpoints|socindex|psycarticles|^eric$|education research complete|greenfile|intelecom|pubmed|medline|naxos|oxford english|oed|rcl|resources for college|science( )?direct|kanopy/';
if (preg_match($dbQuery, $query)) {
    $url = 'index.php?az&query=' .urlencode($query);
}
else {
    $url = 'http://0-search.ebscohost.com.lasiii.losrios.edu/login.aspx?authtype=ip&groupid=main&profile=eds&direct=true&site=eds-live&bquery=' . urlencode($query);
}
header('Location: ' .$url);
?>