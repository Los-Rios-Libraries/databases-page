<?php
$formatList = implode(' ', $db -> type);
$topPick = '';
if (strpos($db->top, 'yes') !== false) {
 $topPick = 'top-pick';
}
echo "<li class=\"db-entry active " .$formatList . " " . $topPick . "\">\n";
echo "<h3><a class=\"db-name\" href=\"" .$url ."\">" .$db-> name ."</a> <span class=\"vendor\">(" . $db -> vendor .")</span></h3>\n";
echo "<p class=\"db-desc\">" .$db ->description . "</p>\n";
echo "<dl class=\"internal-links\">\n";
echo "<dt class=\"cat-list\">Categories:</dt> ";
$dbCategories = $db -> category;
for ($m = 0; $m < count($dbCategories); $m++) {
                   $dbCategory = $dbCategories[$m];
                   $viewCategory = str_replace('-', ' ', $dbCategory);
                   $viewCategory = ucwords($viewCategory);
$dbCategory = str_replace('&amp;', '%26amp%3B', $dbCategory);
                   $catURL = 'index.php?category=' .$dbCategory ;
$catString = '<dd class="db-cat"><a class="desc-category" href="' .$catURL .'">' . $viewCategory . '</a></dd>';
echo $catString;


};
// echo "</dt> \n";
 
echo "<dt class=\"format-list\">Types:</dt>\n";
$dbFormats = $db -> type;
for ($n = 0; $n < count($dbFormats); $n++) {
                   $dbFormat = $dbFormats[$n];
                   $viewFormat = str_replace('-', ' ', $dbFormat);
                   $viewFormat = ucwords($viewFormat);
$dbFormat = str_replace('&amp;', '%26amp%3B', $dbFormat);
                   $formatURL = 'index.php?az&amp;format=' .$dbFormat ;
$formatString = '<dd class="db-format"><a class="desc-format" href="' .$formatURL .'">' . $viewFormat . '</a></dd>';
echo $formatString;


};


echo "</dl>\n";
echo "</li>\n";

?>