<?php
$query = $_POST['find'];
$resource = $_POST['search-type'];

switch ($resource){
case 'onesearch':
    $url = 'http://0-search.ebscohost.com.lasiii.losrios.edu/login.aspx?authtype=ip&groupid=main&profile=eds&direct=true&site=eds-live&bquery=' . urlencode($query);
    break;
    
case 'dbpage':
    $url = 'index.php?az&query=' .urlencode($query);
    break;


    }
header('Location: ' .$url);
?>