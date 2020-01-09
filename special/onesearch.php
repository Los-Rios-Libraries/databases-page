    <?php
    $primoRoot = 'https://caccl-lrccd.primo.exlibrisgroup.com/discovery/search?vid=01CACCL_LRCCD:';
    
    ?>
    <p>Please select your college:</p>
    <ul style="padding-left:2em; list-style-type:disc;">
      <li><a href="<?php echo $primoRoot; ?>arc" onclick="setCookie('homeLibrary', 'arc', 30);">American River College</a></li>
      <li><a href="<?php echo $primoRoot; ?>crc" onclick="setCookie('homeLibrary', 'crc', 30);">Cosumnes River College</a></li>
      <li><a href="<?php echo $primoRoot; ?>flc" onclick="setCookie('homeLibrary', 'flc', 30);">Folsom Lake College</a></li>
      <li><a href="<?php echo $primoRoot; ?>scc" onclick="setCookie('homeLibrary', 'scc', 30);">Sacramento City College</a></li>
    </ul>