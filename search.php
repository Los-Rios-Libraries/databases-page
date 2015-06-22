<?php
$query = $_POST['find'];
$resource = $_POST['search-type'];

switch ($resource){
case 'dbpage':
    $url = 'http://scc.losrios.edu/library/tools/databases/index.php?az&query=' .$query;
    break;

case 'az':
    $url = 'http://atoz.ebsco.com/Titles/SearchResults/9823?SearchType=Contains&Find='.$query . '&GetResourcesBy=QuickSearch';
    break;
case 'onesearch':
    $url = 'http://0-search.ebscohost.com.lasiii.losrios.edu/login.aspx?authtype=ip&groupid=main&profile=eds&direct=true&site=eds-live&bquery=' .$query;
    break;
    }
header('Location: ' .$url);
?>