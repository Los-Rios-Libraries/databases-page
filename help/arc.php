<!-- alt text for images should match text in all elements, to aid with Google Analytics tracking -->
<div id="arc-help">
<div>
	<p><a href="http://www.arc.losrios.edu/arclibrary/Contact_Us/Hours.htm"><img alt="ARC Library Hours" width="136" src="help/arc-img/Hours.png"></a> </p>
	</div>
<div>
    <p><a href="http://www.arc.losrios.edu/arclibrary/Contact_Us.htm"><img alt="Contact a librarian, phone, email, text" height="161" src="help/arc-img/AskLibrarian_Menu.png" width="136" /></a></p>
</div>
    <div id="arc-appt">
        <a href="http://arc.losrios.libcal.com/scheduler.php?iid=525&amp;u=4411&amp;t=Make an appointment!"><img width="136" src="help/arc-img/ResearchAppts.png" alt="Research Appointments"></a>
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
    var arcSched = document.querySelectorAll('#arc-appt a');
    for (var i=0; i<arcSched.length; i++) {
    arcSched[i].addEventListener('click', function(e) {
        e.preventDefault();
        window.open('http://arc.losrios.libcal.com/scheduler.php?iid=525&u=4411&t=Make an appointment!', 'sched','width=660,height=400,left=100,top=100').focus();
        });
    }
</script>
