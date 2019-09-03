<style>
  .libchat_btn_img {width:100px !important;}
</style>
<div id="scc-help">
<img src="loader.gif" id="scc-chat-loader"  height="16" alt="loading">
<div id="libchat_3ed10430124d950ef2b216a68e1b18ba" class="libchat-block"></div>
<p id="chat-online" style="display: none;" class="libchat-msg">Chat now</p>
<p id="chat-offline" style="display: none;" class="libchat-msg">Chat offline; leave us a message</p>
<hr>
<table id="library-hours">
    <caption>Library Hours, Fall 2019 (August 24 &ndash; December 19)</caption>
    <thead>
    <tr>
        <th>Day</th>
        <th>Hours</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><abbr title="Monday">M</abbr> &ndash; <abbr title="Thursday">Th</abbr></td>
        <td>7:30 am &ndash; 9:30 pm</td>
    </tr>
    <tr>
        <td><abbr title="Friday">F</abbr></td>
        <td>7:30 am &ndash; 5 pm</td>
    </tr>
        <tr>
        <td><abbr title="Saturday">Sa</abbr></td>
        <td>9 am &ndash; 3 pm</td>
    </tr>
    <tr>
        <td><abbr title="Sunday">Su</abbr></td>
        <td>Closed</td>
    </tr>
    </tbody>
</table>
<p><a href="//www.scc.losrios.edu/library/about/hours">More about library hours</a></p>
</div>
<script src="https://v2.libanswers.com/load_chat.php?hash=3ed10430124d950ef2b216a68e1b18ba"></script>
<script>
  //  hideZ();
checkCookies('newWindowLinks');

    // libraryh3lp presence

  (function() {

var jqWait = setInterval(function() {
	if (typeof(jQuery) === 'function')
	{
		clearInterval(jqWait);
    // text that will be placed below icon
var online = $('#chat-online');
var offline = $('#chat-offline');
// alt attributes set in LibChat widget
var onlineAlt = 'Ask Us';
var offlineAlt = 'Offline';
var chatID = '12136'; // widget ID
var waitForChat = setInterval(function() {
	console.log('working');
	var btn = $('.libchat_btn_img'); // button doesn't load until after page load--this is class given it by Springshare
	if (btn.length) {
		clearInterval(waitForChat);
    $('#scc-chat-loader').remove();
		if (btn.attr('alt') === onlineAlt) { // if it is online, let will need to poll in case it goes offline
			// move text to inside anchor
			online.insertAfter(btn).show();
			// poll API for offline status
			var checkPresence = setInterval(function() {
				$.getJSON('https://losrios.libanswers.com/1.0/chat/widgets/status/' + chatID)
				.done(function(d) {
					console.log(d);
					if (d.online !== true) { 
						clearInterval(checkPresence); // this is just one-way
						online.hide(2, function() {
							btn.attr({'style': '40% !important', 'alt': offlineAlt}); // change size of button
							offline.insertAfter(btn).show(); // move relevant paragraph into anchor
							// clone to remove event handler
							var newAnchor = btn.parent().clone();
							newAnchor.attr('href', '/library/services/ask-librarian');
							btn.parent().remove();
							$('.libchat-block').append(newAnchor);
							
							
						});
					}
				})
				.fail(function(a,b,c) {
					ga('send', 'event', 'libchat presence check', 'error', c);
				});
			}, 20000);
	
		}
		
		else if (btn.attr('alt') === offlineAlt) {
			clearInterval(waitForChat);
			offline.insertAfter($('.libchat_btn_img')).show();
		}
		
	}
	
}, 1000);

		$('#choose-library button').on('click', function() {
			clearInterval(check_presence);
		});
	}
}, 100);
  }());
</script>
