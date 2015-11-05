<form id="multi-search" action="search.php" method="post">
 <label for="dbpage-query">Search</label>
<input type="text" name="find" id="dbpage-query">
 <div id="form-remainder" class="hidden">
 <div id="radio-intro">What are you looking for?</div>
 <div id="search-options">
   <div>
  <input type="radio" name="search-type" value="onesearch" id="search-onesearch" checked >
  <label for="search-onesearch" >Articles, ebooks, journals and other items</label>
 </div>

  <div class="search-exp hidden">We'll send your keywords to OneSearch, which helps you find articles, ebooks &amp; more across a large number of databases</div>
   </div>
 <div>
  <input type="radio" name="search-type" value="dbpage" id="search-db" >
  <label for="search-db" >An individual database</label>
 </div>
 <div class="search-exp hidden">We'll check this site to see if the library provides access to a certain database</div>


  <input type="submit" value="search">
     <button type="button" id="form-closer">X Close</button>
</div>

</form>