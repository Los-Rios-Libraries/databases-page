<style>
    .service {margin-bottom:10px; clear:both;}
    .service img {clear:both; float:left; padding:0 .5em 20px 0; width:24px; height:auto;}

</style>

<div id="services">
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm"><img src="http://www.arc.losrios.edu/Images/Images-arc/Library/clock_40.png" alt="Hours"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm"><p>Hours</p></a>
    </div>
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm#phone"><img src="http://www.arc.losrios.edu/Images/Images-arc/Library/phone_39.png" alt="Phone"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Hours_and_Contact_Info.htm#phone"><p>Phone</p></a>
    </div>
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><img src="http://www.arc.losrios.edu/Images/Images-arc/Library/email_40.png" alt="Email"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><p>Email</p></a>
    </div>
    <div class="service">
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><img src="http://www.arc.losrios.edu/Images/Images-arc/Library/SMS_39.png" alt="Text"></a>
                                                                   
        <a href="http://www.arc.losrios.edu/arclibrary/Get_Help.htm#askalibrarian"><p>Text</p></a>
    </div>
    <div class="service" id="arc-appt">
        <a href="http://arc.losrios.libcal.com/scheduler.php?iid=525&amp;u=4411&amp;t=Make an appointment!"><img src="http://www.arc.losrios.edu/Images/Images-arc/Library/Calendar_40.png" alt="Research Appointments"></a>
                                                                   
        <a href="http://arc.losrios.libcal.com/scheduler.php?iid=525&amp;u=4411&amp;t=Make an appointment!"><p>Research Appointments</p></a>
    </div>
    <div class="service">
        <a href="https://www.facebook.com/arclibrary"><img src="http://www.arc.losrios.edu/Images/Images-arc/Library/Facebook_39.png" alt="Facebook"></a>
                                                                   
        <a href="https://www.facebook.com/arclibrary"><p>Facebook</p></a>
    </div>
    <iframe frameborder="1" height="240" src="https://libraryh3lp.com/chat/asklibrarian@chat.libraryh3lp.com?skin=12216&amp;sounds=true" style="height: 275px; width: 190px; border: #333333 1px inset;" width="320"></iframe>
</div>

<script>
    hideZ();
    checkCookies('newWindowLinks');
    var arcSched = document.querySelectorAll('#arc-appt a');
    for (var i=0; i<arcSched.length; i++) {
    arcSched[i].addEventListener('click', function(e) {
        e.preventDefault();
        window.open('http://arc.losrios.libcal.com/scheduler.php?iid=525&u=4411&t=Make an appointment!', 'sched','width=660,height=400,left=100,top=100').focus();
        });
    }
</script>