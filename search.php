<?php
$query = $_POST['find'];
$resource = $_POST['search-type'];

switch ($resource){
case 'dbpage':
    $url = 'index.php?az&query=' .urlencode($query);
    break;

case 'az':
    $url = 'http://atoz.ebsco.com/Titles/SearchResults/9823?SearchType=Contains&Find='. urlencode($query) . '&GetResourcesBy=QuickSearch';
    break;
case 'onesearch':
    $url = 'http://0-search.ebscohost.com.lasiii.losrios.edu/login.aspx?authtype=ip&groupid=main&profile=eds&direct=true&site=eds-live&bquery=' . urlencode($query);
    break;
    }
header('Location: ' .$url);
?>