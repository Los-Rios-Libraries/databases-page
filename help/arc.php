<style>
    .service {margin-bottom:10px; clear:both;}
    .service img {clear:both; float:left; padding:0 .5em 20px 0; width:24px; height:auto;}

</style>
<!-- alt text for images should match text in a elements, to aid with Google Analytics tracking -->
<div id="services">
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm"><img src="help/arc-img/clock_40.png" alt="Hours"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm"><p>Hours</p></a>
    </div>
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm#phone"><img src="help/arc-img/phone_39.png" alt="Phone"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm#phone"><p>Phone</p></a>
    </div>
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><img src="help/arc-img/email_40.png" alt="Email"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><p>Email</p></a>
    </div>
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><img src="help/arc-img/SMS_39.png" alt="Text"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><p>Text</p></a>
    </div>
    <div class="service" id="arc-appt">
        <a href="http://arc.losrios.libcal.com/scheduler.php?iid=525&amp;u=4411&amp;t=Make an appointment!"><img src="help/arc-img/Calendar_40.png" alt="Research Appointments"></a>
                                                                   
        <a href="http://arc.losrios.libcal.com/scheduler.php?iid=525&amp;u=4411&amp;t=Make an appointment!"><p>Research Appointments</p></a>
    </div>
    <div class="service">
        <a href="https://www.facebook.com/arclibrary"><img src="help/arc-img/Facebook_39.png" alt="Facebook"></a>
                                                                   
        <a href="https://www.facebook.com/arclibrary"><p>Facebook</p></a>
     </div>
</div>
<!-- Place this div in your web page where you want your chat widget to appear. -->
<div class="needs-js">chat loading...</div>

<!-- Place this script as near to the end of your BODY as possible. -->
<script type="text/javascript">
  (function() {
    var x = document.createElement("script"); x.type = "text/javascript"; x.async = true;
    x.src = (document.location.protocol === "https:" ? "https://" : "http://") + "libraryh3lp.com/js/libraryh3lp.js?8699";
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