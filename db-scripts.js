// cookies
var setCookie = function(obj) {
	var expires = ''; // if obj.exp is not set, cookie is session-only
	if (obj.exp) {
		var multiplier = 60 * 60 * 24; // assumes days
		if (obj.unit === 'hours') {
			multiplier = multiplier / 24;
		} else if (obj.unit === 'minutes') {
			multiplier = 60;
		} else if (obj.unit === 'months') {
			multiplier = multiplier * 30;
		}
		expires = 'max-age=' + obj.exp * multiplier + ';';
	}
	document.cookie = obj.cname + '=' + obj.value + '; ' + expires + 'path=/;domain=losrios.edu;secure=true';
};


var getCookie = function(cname) {
	var name = cname + '=';
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1);
		if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
	}
	return '';
};
var showDBNos = function() {
	var dbNo = $('#main .db-name:visible').length;
	var numberDisplay = $('.show-db-no');
	if (numberDisplay.length) {
		dbNoS = dbNo.toString();
		$('.db-no').text(dbNoS);
		if (dbNo === 1) {
			numberDisplay.html(numberDisplay.html().replace('Databases', 'Database'));
		}
		if ($('#az-home').length) {
			numberDisplay.each(function (i) {
				if (i !== 0) {
					$(this).remove();
				} else {
					$(this).prependTo($('#main'));
				}
			});
		}
		numberDisplay.show();
	}
};
var submitSearch = function(kw) {
	var dbPatterns = /^(ebsco$|proquest|academic search complete|films on demand|cinahl|j( )?stor|ethnologue|gale (virtual|ebook)|gvrl|cq|onesearch|oxford art|grove|art( )?stor|ebooks|kanopy|google scholar|business source|opposing viewpoints|dailies|psycarticles|^eric$|education research complete|greenfile|omnigraphic|health reference series|pubmed|medline|naxos|newsbank|ovid|oxford english|oed|science( )?direct|kanopy|digital theat|masterfile|wiley|sage)/i;
	if (dbPatterns.test(kw) === true) {
		console.log('found match');
		location.href = 'index.php?az&query=' + encodeURIComponent(kw);
	} else {
		var query = 'any,contains,' + encodeURIComponent(kw);
		var str = '';
		$('#onesearch-params input').each(function() {
			str += '&' + $(this).attr('name') + '=' + $(this).val();
			});
		var url = 'https://caccl-lrccd.primo.exlibrisgroup.com/discovery/search?query=' + query + str;
		if (getCookie('newWindowLinks') === 'yes') {
			window.open(url);
		} else {
			location.href = url;
		}
	}


};
var checkZeros = function() { // if there are no entries at all, show suggestions.
	if ((!($('.problem-description').length)) && (!($('#main .special').length)) && (!($('#db-display').length))) {
		$('#zero-notice').remove();
		if ($('#main .active-db:visible').length === 0) {
			//   $('.category').removeClass('hidden').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
			var a = $('#main');
			a.append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry!</div>');
			a.append($('#multi-search'));
			$('#dbpage-query').addClass('form-emphasis');
			//   $('#form-remainder').prop('class', 'opened');
			$('#form-remainder').removeClass('hidden');
		}
	}
};
var currentCollege = $('body').data('college');
setCookie({cname: 'homeLibrary',value: currentCollege, exp: 30});

$('#multi-search').on('submit', function(e) { // if users do not select autocomplete item and instead click search or enter
	e.preventDefault();
	submitSearch($('#onesearch-query').val());
});




$('.db-name').each(function() { // correct capitalization while preserving php's sorting
	var dbName = $(this);
	var arr = dbName.html().split(' ');
	var reg = /^Ahfs|^Apa$|^Dsm|^Ebsco|Cinahl|Cq|Eric|Jstor|^Lgbtq|^Mas$|Medline|^Sage/;
	for (var i = 0; i < arr.length; i++) {
		if (reg.test(arr[i])) {
			arr[i] = arr[i].toUpperCase();
		}
	}
	var newStr = arr.join(' ');
	dbName.html(newStr);
	if (dbName.html().indexOf('Ebook Col') > -1) {
		dbName.html(dbName.html().replace('Ebook', 'eBook'));
	}
});
// contract nav by default on small screens

if ($(window).width() < 965) {
	$('#main-nav').collapse();
}

// if heading has no items listed, hide the entire section - keep this even if getting rid of filters.
var category = $('.category');
category.each(function() {
	var e = $(this);
	e.removeClass('active-db d-none');
	var dbs = e.find('li');
	//  console.log(dbs);
	if ((dbs.hasClass('active-db')) && (dbs.is(':visible'))) {
		e.addClass('active-db');
	} else {
		e.addClass('d-none');
	}
});
checkZeros();
// fix borders in last item of lists--can't do this in pure css because of structure of description list
$('dt').prev('dd').addClass('last-dd');
// truncate trial database description
var trialDesc = $('#trial-dbs .db-desc');
trialDesc.each(function() {
	var a = $(this);
	var desc = a.html();
	// alert(desc);
	var shortText = $.trim(desc).substring(0, 60).split(' ').slice(0, -1).join(' ') + '... <button class="trial-desc-exp btn btn-link" type="button">more</button>';
	a.html(shortText);
	a.show();
	$('.trial-desc-exp').on('click', function() {
		$(this).parent().html(desc);
	});
});

$('.alpha').each(function() {
	if ($(this).find('li').length === 0) {
		$(this).hide();
	}
});



// highlight current page in nav where applicable
$('#main-nav li a').each(function() {
	var a = $('#title-cat').text();
	var b = $('#title-alpha').text().toLowerCase();
	var c = $(this);
	var d = c.text();
	if ((a === d) || (b === d)) {
		c.addClass('active');
	}
});








	var colProps = {
		'arc': {
			cust: 'amerriv',
			singleCol: 'a'

		},
		'crc': {
			cust: 'cosum',
			singleCol: 'c'

		},
		'flc': {
			cust: 'ns015092',
			singleCol: 'f'

		},
		'scc': {
			cust: 'sacram',
			singleCol: 's'

		}
	};
	var makeDate = function(str) {
		var arr = str.split('-');
		var d = new Date();
		d.setFullYear(arr[0], arr[1] - 1, arr[2]);
		return d;
	};
	var today = new Date();
	$('.db-entry').each(function() { // hide databases not shown to particular colleges
		var a = $(this);
		if (a.data('college')) {
			if (a.data('college').indexOf(colProps[currentCollege].singleCol) === -1) {
				a.hide();
			}
		}
		if (a.data('expiration')) {
			if (a.data('expiration') !== '') {
				var d = makeDate(a.data('expiration'));
				d.setHours(23, 59, 59);
				if (today > d) {
					a.hide();
				}
			}
		}
		if (a.data('startdate')) {
			if (a.data('startdate') !== '') {
				var e = makeDate(a.data('startdate'));
				e.setHours(0);
				if (today < e) {
					var dbName = a.find('.db-name');
					dbName.hide().after(dbName.text());
					if (a.find('.open-db-search').length) {
						a.find('.open-db-search').hide();
					}
				} else {
					a.find('.start-note').hide();
				}
			}
		}

	});
	// hide trial dbs if they exist but have been hidden because of exp date. SHould really be taking care of this in PHP
	if ($('#trial-dbs .db-entry:visible').length === 0) {
		$('#trial-dbs').hide();
	}
if (!($('#cat-home').length)) {
	showDBNos();
}




if (getCookie('newWindowLinks') === 'yes') {
	$('#newwin-check').prop('checked', true);
			$('.db-name, .headnav a, #pubfinder a, #multi-search').attr('target', '_blank');
}
$('#newwin-check').on('click', function() {
	var a = $(this);
	var b = $('.db-name, .search-one-db');
	if (a.is(':checked')) {
		setCookie({
			cname: 'newWindowLinks',
			value: 'yes',
			exp: 30
		});
		b.attr('target', '_blank');
		if ($('#search-db').prop('checked', false)) {
			$('#multi-search').attr('target', '_blank');
		}
	} else {
		setCookie({
			cname: 'newWindowLinks',
			value: 'no',
			exp: 1
		});
		b.removeAttr('target');
		$('#multi-search').removeAttr('target');
	}
});

var currentURL = location.href;
if (currentURL.match('college=')) {
	currentURL = currentURL.replace(/(\?|&)college.*/, '');
	history.replaceState(currentURL, document.title, currentURL);
}
if (currentURL.match(/logged(in|out)/)) {
	currentURL = currentURL.replace(/\?logged.*/, '');
	//  replaceURL = currentURL.replace(/.*losrios.edu\//, '');
	history.replaceState(currentURL, document.title, currentURL);
}
/*
// to be used if we do a "read more" thing
$('.desc-readmore').on('click', function() {
    var a = $(this);
    a.next('.desc-remainder').removeClass('hidden');
    a.addClass('hidden');
    
});
*/
$('.open-db-search').on('click', function() {
	var searchButton = $(this);
	var target = '';
	var winSetting = getCookie('newWindowLinks');
	if (winSetting === 'yes') {
		target = ' target="_blank" ';
	}
	var dbName = searchButton.nextAll('h3').find('.db-name');
	var dbNameText = dbName.text();
	var dbNameLower = dbNameText.toLowerCase();
	dbNameLower = dbNameLower.replace(/ /g, '-');
	var vendor = searchButton.nextAll('h3').find('.vendor').text().toLowerCase();
	vendor = vendor.replace(/[\(\):]/g, '');
	vendor = vendor.replace(/ /g, '-');
	var dbEl = document.getElementById(dbNameLower);
	$('.open-db-search').removeClass('d-none');
	var searchForms = $('.search-one-db');
	if (!dbEl) { // this is causing problem on main categories page when database is listed twice... if one is used and then you try another, the element already exists but elsewhere. Does it matter?
		searchForms.hide();
		var dbURL = dbName.attr('href');
		var ehost = '';
		if (dbURL.indexOf('ehost') > -1) {
			var ebCode = dbURL.split(/[= ]+/).pop();
			ehost = '<input type="hidden" name="ehost" value="' + ebCode + '">';
		}
		var searchDB = '<form class="search-one-db float-right" method="post" action="search-db.php" ' + target + '><label class="search-one-db-l sr-only" for="' + dbNameLower + '">Search ' + dbNameText + '</label><input name="query" id="' + dbNameLower + '" type="text"><input type="hidden" name="vendor" value="' + vendor + '"><input type="hidden" name="db-name" value="' + dbNameLower + '">' + ehost + '<input type="hidden" name="db-url" value="' + encodeURIComponent(dbName.attr('href')) + '"><button class="search-btn btn" type="submit"><svg width="100%" height="100%" viewBox="0 0 24 24" y="264"><use xlink:href="#magnifyingglass" preserveAspectRatio="xMidYMid meet"></svg></button></form>';
		searchButton.addClass('d-none');
		searchButton.after(searchDB);
		searchButton.next(searchForms).fadeIn();
		var input = searchButton.next(searchForms).find(':text');
		input.focus();
	//	defaultAuto(input, 'quick');
	} else {
		searchButton.addClass('d-none');
		searchForms.hide();
		searchButton.next(searchForms).fadeIn();
		document.getElementById(dbNameLower).focus();
	}
});

$('#remove-proxy').on('click', function() {
	removeProxy();
	setCookie({
		cname: 'dbProxy',
		value: 'removed'
	});


});
$('#force-login').on('click', function() {
	setCookie({
		cname: 'ezproxyrequireauthenticate2',
		value: '2'
	});
	$(this).hide();
	$('<p style="display:none;">This computer will now see login prompts when accessing resources. <button id="reset-login" type="button" class="btn btn-sm btn-primary">Reset </button></p>').insertAfter($(this)).fadeIn();
	$('#reset-login').on('click', function() {
		resetLogin($(this));
	});
	$('#remove-proxy').fadeOut();
	$('#sso').show();
});
if (getCookie('dbProxy') === 'removed') {
	removeProxy();
}

function resetLogin(el) {
	setCookie({
		cname: 'ezproxyrequireauthenticate2',
		value: '0'
	});
	el.closest('aside').fadeOut();
	$('#sso').fadeOut();
	$('#remove-proxy').fadeIn();
}
$('#reset-login').on('click', function() {
	resetLogin($(this));
});
if ($('#reset-login').length) {
	$('#sso').show();
}

function removeProxy() {
	$('.db-name').each(function() {
		var h = $(this).attr('href');
		var deProxy;
		if (h.indexOf('//0-') > -1) {
			deProxy = h.replace('//0-', '//');
			if (h.indexOf('https') > -1) {
				var parts = deProxy.split('.edu/');
				parts[0] = parts[0].replace(/\-/g, '.').replace(/$/, '.edu/');
				deProxy = parts.join('');
				console.log(deProxy);
			}
			deProxy = deProxy.replace('.lasiii.losrios.edu', '');
			$(this).attr('href', deProxy);
		} else if (h.indexOf('ezproxy') > -1) {
			deProxy = h.replace(/https:\/\/ezproxy\.losrios\.edu\/login\?(auth=custom&)?url=/, '');
			$(this).attr('href', deProxy);
			$('#sso').hide();
		}
	});
	var proxyDiv = $('#proxy');
	$('#remove-proxy').attr('id', 'add-proxy').html('&#8635; Restore proxy string to URLs');
	$('<p class="special">Proxy string has been removed from URLs; databases may not be accessible.</p>').hide().prependTo(proxyDiv).fadeIn();
	$('#add-proxy').on('click', function() {
		setCookie({
			cname: 'dbProxy',
			value: 'restored'
		});
		proxyDiv.find('p').remove();
		proxyDiv.fadeOut('fast');
		location.reload();
	});
}
$('#disable-sso').on('click', function() {
	location.href = 'https://ezproxy.losrios.edu/login?auth=custom';
});

(function() {
	if (getCookie('ezproxy') !== '') {
		$('#proxy-status').html('in');
		$('#proxy-toggle').html('Sign out');
	}

}());
$('#proxy-toggle').on('click', function() {
	if (getCookie('ezproxy') !== '') {
		location.href = 'https://ezproxy.losrios.edu/logout';
	} else {
		location.href = 'https://ezproxy.losrios.edu';
	}
});
(function() {
	var alert = $('.proxy-dialog');
	if (alert.length) {
		alert.fadeIn();
		setTimeout(function() {
			alert.fadeOut();
		}, 1500);
	}

}());

function showNote(obj) {
	/*
	 call using e.g.
	 showNote({
	 message: 'Due to scheduled maintenance, access to databases may be interrupted the morning of Friday, May 25.',
	 start: '2018-05-21',
	 end: '2018-05-26' // this is the beginning of the day, so if you want it to show that day, must set to the next day
	 });
	 */
	var cookieID = obj.cid || '';
	var cName = 'dbHideAlert_' + cookieID;
	if (getCookie(cName) !== 'hide') {
		var d = new Date(); // time when page is viewed
		var parseDate = function(str) {
			var arr = str.split('-');
			return new Date(arr); // for some reason this doesn't work if you include more than year-month-date
		};
		var start = new Date('1970');
		// start and end properties are optional
		if (obj.start) {
			start = parseDate(obj.start);
		}
		var end = new Date('3000');
		if (obj.end) {
			end = parseDate(obj.end);
		}
		var exp = 2; // default cookie expiration is two days
		if (obj.exp) {
			exp = obj.exp;
		}
		//console.log(start);
		//console.log(end);
		var text = obj.message || '';
		if ((d >= start) && (d <= end) && (text !== '')) {
			var fill = '';
			if (currentCollege !== 'scc') {
				fill = 'style=fill:#fff;';
			}
			$('#problem-notification').css('margin-top', '-20px');
			$('<p id="db-alert" role="alert" class="alert alert-warning text-center" style="display:none;">' + text + ' <button class="btn btn-secondary btn-sm float-right" type="button" id="message-dismiss">Hide this message <svg width="14" height="14" viewBox="0 0 44 44" aria-hidden="true" focusable="false" ' + fill + '><path d="M0.549989 4.44999L4.44999 0.549988L43.45 39.55L39.55 43.45L0.549989 4.44999Z" /><path d="M39.55 0.549988L43.45 4.44999L4.44999 43.45L0.549988 39.55L39.55 0.549988Z" /></svg></button></p>').appendTo($('#problem-notification')).fadeIn();
			$('#message-dismiss').on('click', function() {
				$('#db-alert').fadeOut();
				setCookie({
					cname: cName,
					value: 'hide',
					exp: exp
				}); // cookie expires in just two days
			});
		}
	}


}
$('.db-name').on('click', function() {
	if (getCookie('newWindowLinks') !== 'yes') {
		$('#loader').css({
			position: 'fixed',
			top: '30%',
			left: '48%',
			zIndex: '1030'
		}).show();

	}
	setTimeout(function() {
		$('#loader').hide();
	}, 3000);
});
$('#onesearch-query').on('focusin', function() {
	$('#search-exp').slideDown();
}).
on('focusout', function() {
	$('#search-exp').slideUp();
});