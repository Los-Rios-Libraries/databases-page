
  

   <form id="multi-search" action="https://caccl-lrccd.primo.exlibrisgroup.com/discovery/search" method="get" aria-describedby="search-exp">
 <div class="form-group row mb-0">
  <div class="col-9 p-0" >
    <label for="onesearch-query" class="sr-only">Search</label>
    <input type="hidden" name="query" value="any,contains,">
     <input type="text" name="query"  class="form-control" id="onesearch-query" placeholder="Search Databases">
     <div id="onesearch-params">
      <input type="hidden" name="tab" value="everything">
     <input type="hidden" name="search_scope" value="<?php echo $college; ?>_everything">
     <input type="hidden" name="vid" value="01CACCL_LRCCD:<?php echo $college; ?>">
     <input type="hidden" name="facet" value="tlevel,include,online_resources,lk">
     </div>
     
  </div>
  

   <div class="col-3 p-0">
    <button type="submit" value="submit" class="open-db-search btn btn-secondary" id="dbpage-query-submit">
     <svg width="100%" height="100%" viewBox="0 0 24 24" y="264"><use xlink:href="#magnifyingglass" style="width:24px;"  preserveAspectRatio="xMidYMid meet"></svg>
    </button>
   </div>
  

    
   </div>
   
 
 
  <!--<input type="submit" value="search" id="dbpage-query-submit" class="sr-only">-->


</form>
 
<div class="row">
 
 <div class="col shadow-sm p-2 mb-1  border rounded position-absolute bg-light" id="search-exp" style="display:none; z-index:9999;" >
  We&apos;ll send your  keywords to OneSearch, which helps you find articles, ebooks &amp; more across a large number of databases.
 </div>
</div>
