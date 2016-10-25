<?php
$formatList = implode(' ', $db -> type);
$topPick = '';
if (strpos($db->top, 'yes') !== false) {
 $topPick = 'top-pick';
}
$description = $db -> description;
if (isset($db -> trial)) {
 $trialclass = 'trial';
 
}
else {
 $trialclass = '';
}
/*
// automatically inserts a read more button after first period... only make sense if descriptions are longer. Maybe better approach is to have separate field in json file.
if (preg_match('/\. /', $description)) {
$descParts = preg_split('/\. /', $description, 2);
$description = $descParts[0] . ". <button class=\"desc-readmore\">Read more</button><span class=\"hidden desc-remainder\">" .$descParts[1] . "</span>";
}
*/
echo "<li class=\"db-entry active " .$formatList . " " .$trialclass . " " . $topPick . "\">\n";
$searchButton = "<button class=\"open-db-search\" title=\"Search this database\"><img height=\"16\" width=\"16\" src=\"search.png\" alt=\"search\"></button>\n";

$name = $db -> name;
// if ((strpos($name, 'Auto') > -1) || (strpos($name, 'Artstor') > -1) || (strpos($name, 'Lexis') > -1) || (strpos($name, 'Country') > -1) ) {
 if (preg_match('/Auto|Artstor|Lexis|Country|Opposing|Safari|ScienceDirect|Statista|CollegeSource|Noodle/', $name) === 1) {
 $searchButton = '';
}
echo $searchButton;
echo "<h3><a class=\"db-name\" href=\"" .$url ."\">" .$db-> name ."</a> <span class=\"vendor\">(" . $db -> vendor .")</span></h3>\n";
echo "<p class=\"db-desc\">" . $description . "</p>\n";
if ((isset($format)) || (isset($query)) || (isset($category))) {
echo "<dl class=\"internal-links\">\n";
if (!isset($category)) {
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
}
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
}

echo "</li>\n";
?>