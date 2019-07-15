<!-- alt text for images should match text in all elements, to aid with Google Analytics tracking -->
<div id="arc-help">
<div>
	<p><a href="https://www.arc.losrios.edu/student-resources/library/about/hours"><img alt="ARC Library Hours" width="136" src="help/arc-img/Hours.png"></a> </p>
	</div>
<div>
    <p><a href="https://www.arc.losrios.edu/student-resources/library/contact"><img alt="Contact a librarian, phone, email" height="135" src="help/arc-img/AskLibrarian_Menu.png" width="136" /></a></p>
</div>
    <div id="arc-appt">
        <p><a href="https://arc_losriosdss.ingeniuxondemand.com/student-resources/library/research/make-an-appointment"><img alt="Research Appointments" height="40" src="help/arc-img/ResearchAppts.png" width="136" /></a></p>
    </div>


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

    	if (typeof(jQuery) === 'function') {
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

