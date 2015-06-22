<form class="hidden" action="search.php" method="post" id="multi-search">
 <label for="dbpage-query">Search for online library resources:</label>
 <input type="text" name="find" id="dbpage-query">
 <div id="radio-intro">What are you looking for?</div>
 <div id="search-options">
 <div>
  <input type="radio" name="search-type" value="dbpage" id="search-db" checked >
  <label for="search-db" >A database</label>
 </div>
 <div class="search-exp hidden">Use this site to find out if the library provides access to a certain database</div>
 <div> <input type="radio" name="search-type" value="az" id="search-journal">
 <label for="search-journal" >A journal, magazine or other publication by name</label>
 </div>
 <div class="search-exp hidden">Use the A-to-Z Service to find out which database contains a particular publication</div>
 <div>
  <input type="radio" name="search-type" value="onesearch" id="search-onesearch">
  <label for="search-onesearch" >Articles, ebooks or other items</label>
 </div>

  <div class="search-exp hidden">Use OneSearch to find articles, ebooks &amp; more across a large number of databases</div>
   </div>
  <input type="submit" value="search">
</form>