<?php
if ($homeLibrary !== 'unknown') {
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
      $wID = '107590'; // default shouldn't be needed, but just in case
  }
  header('Location: https://ezproxy.losrios.edu/login?url=https://fod.infobase.com/PortalPlayLists.aspx?wid=' . $wID);
}
?>