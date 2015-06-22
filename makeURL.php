<?php
    $root = $db->urlRoot;
    $path = $db->urlPath;
    $path = str_replace('&', '&amp;', $path);
    $proxy = $db->proxy;
    if($proxy === 'yes') {
        $url = 'http://0-' .$root . '.lasiii.losrios.edu/' .$path;
    }   
    else {
    $url = 'http://' .$root .'/'.$path;
    }
?>