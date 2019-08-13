<div id="scc-help">
<div class="needs-js"><img src="loader.gif"  height="16" alt="loading"></div>

<div class="libraryh3lp" id="ask-block-active" jid="homepage@chat.libraryh3lp.com" 
style="display: none;">
    <div class="ask-block">
         <a href="https://us.libraryh3lp.com/chat/homepage@chat.libraryh3lp.com?skin=22093">
        <img src="//www.library.losrios.edu/resources/ask-icons/scc.png" alt="Ask a Librarian">
        <p><strong>Live Chat</strong></p>
         </a>
         <p><strong>Phone:</strong> 916&ndash;558&ndash;2461</p>
    </div>
</div>

<div class="libraryh3lp" id="ask-block-inactive" style="display: none;"> 
<div class="ask-block"><a href="//www.scc.losrios.edu/library/services/ask-librarian/"><img src="//www.library.losrios.edu/resources/ask-icons/scc.png" alt="Ask a Librarian"></a><p>Chat is offline. <a href="//www.scc.losrios.edu/library/services/ask-librarian/">Leave a message</a> or call us at 916&ndash;558&ndash;2461.</p></div>
</div>
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
<script>
  //  hideZ();
checkCookies('newWindowLinks');

    // libraryh3lp presence

  (function() {
    var check_presence = function() { // alternative to standard, resource-heavy libraryh3lp presence check. reference: https://libraryh3lp.com/presence/jid/homepage/chat.libraryh3lp.com/js
	$.getScript('https://libraryh3lp.com/presence/jid/homepage/chat.libraryh3lp.com/js')
    .done(function() {
		replaceChat(jabber_resources[0].show);
	})
    .fail(function(a,b,c) {
		ga('send', 'event', 'libraryh3lp presence check', 'error', c); 
	});
};

var replaceChat = function(status) {
	if (status === 'available' || status.show === 'chat') {
		$('#ask-block-inactive, .needs-js').hide(1, function() {
			$('#ask-block-active').fadeIn();
		});
	} else {
		$('#ask-block-active, .needs-js').hide(2, function() {
			$('#ask-block-inactive').fadeIn();
		});
	}
};
var jqWait = setInterval(function() {
	if (typeof(jQuery) === 'function')
	{
		clearInterval(jqWait);
		check_presence();
		setInterval(check_presence, 20000);
		$('#ask-block-active a').on('click', function(e)
				{
					e.preventDefault();
					window.open('https://us.libraryh3lp.com/chat/homepage@chat.libraryh3lp.com?skin=22093',
						'chat', 'resizable=1,width=320,height=460,left=100, top=100');
				});
		$('#choose-library button').on('click', function() {
			clearInterval(check_presence);
		});
	}
}, 100);
  }());
</script>
