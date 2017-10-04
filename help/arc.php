<!-- alt text for images should match text in all elements, to aid with Google Analytics tracking -->
<div id="arc-help">
<div>
	<p><a href="http://www.arc.losrios.edu/arclibrary/Contact_Us/Hours.htm"><img alt="ARC Library Hours" width="136" src="help/arc-img/Hours.png"></a> </p>
	</div>
<div>
    <p><a href="http://www.arc.losrios.edu/arclibrary/Contact_Us.htm"><img alt="Contact a librarian, phone, email, text" height="135" src="help/arc-img/AskLibrarian_Menu.png" width="136" /></a></p>
</div>
    <div id="arc-appt">
        <button id="mySched27927" type="button"><img alt="Research Appointments" height="40" src="help/arc-img/ResearchAppts.png" width="136" /></button>
    </div>
    
</div>
<!-- Place this div in your web page where you want your chat widget to appear. -->
<div class="needs-js">chat loading...</div>
</div>
<!-- Place this script as near to the end of your BODY as possible. -->
<script type="text/javascript">
  (function() {
    var x = document.createElement("script"); x.type = "text/javascript"; x.async = true;
    x.src = (document.location.protocol === "https:" ? "https://" : "http://") + "libraryh3lp.com/js/libraryh3lp.js?9603";
    var y = document.getElementsByTagName("script")[0]; y.parentNode.insertBefore(x, y);
  })();
</script>

<script>
    checkCookies('newWindowLinks');

    function attachDialog() { // from Springshare
    	$("#mySched27927").LibCalMySched({
    		iid: 525,
    		uid: 0,
    		gid: 1123,
    		width: 500,
    		height: 450
    	});

    }
    var wait = setInterval(function() { // wait for jQuery to load

    	if (typeof(jQuery) == 'function') {
    		clearTimeout(wait);
    		if (!(document.getElementById('arc-sched-scr'))) { // if libcal scheduler script is not already loaded, load it
    			var a = document.createElement('script');
    			a.async = true;
    			a.id = 'arc-sched-scr'; // allows us to check for it before loading
    			a.src = '//api3.libcal.com/js/myscheduler.min.js?002';
    			document.getElementsByTagName('body')[0].appendChild(a); // add script below jQuery
    			$('#arc-sched-scr').on('load', function() { // wait for it to load since we need the LibCalMySched function
    				attachDialog();
    			});
    		} else {
    			attachDialog();
    		}
    	}
    }, 50);
    	
  
</script>
<!-- Place the following link anywhere in your page. Make sure the id "mySched27927" matches with the above code: jQuery("#mySched27927")  //-->

