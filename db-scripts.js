     // db autocomplete
function showDBNos() {
  var dbNo = $('#main .db-name:visible').length;
  var numberDisplay = $('#show-db-no');
  if (dbNo < 70)
  {
    dbNoS = dbNo.toString();
    $('#db-no').text(dbNoS);
    if (dbNo === 1)
    {
      numberDisplay.html(numberDisplay.html().replace('Databases', 'Database'));
    }
    numberDisplay.attr('class', 'show');
  }
  else
  {
    numberDisplay.attr('class', 'hidden').attr('aria-hidden', 'true');
  }
}
function defaultAuto(el, searchType) {
       el.autocomplete(
{
  source: function (request, response)
  {
    $.getJSON(
    {
      url: 'https://widgets.ebscohost.com/prod/simplekey/autocomplete/autocomp.php',
      data: {
        q: encodeURIComponent(request.term)
      }
    }).done(function (data)
    {
      //        console.log(data);
      data = JSON.parse(data); // turn response into JSON object
      var array = $.map(data, function (value) // convert to array
      {
        return [value];
      });
      var output = []; // create array of suggested terms, which is what jQuery UI expects
      var arrayVals = array[2]; // this is where the objects are in EBSCO's response
      for (var i = 0; i < arrayVals.length; i++)
      {
        output.push(arrayVals[i].term); // push suggestions into the array
        response(output); // sends the array to jQuery ui - needs to be done inside the loop so it updates as you type
      }
    })
    .fail(function(a,b,c) {
        
        ga('send', 'event', 'eds autosuggest', 'error', c);
        });
  },
  //   minLength: 2,
  select: function (event, ui)
  {
    if (ui.item)
        {
          el.val(ui.item.value);
           
        }
        if (searchType !== 'quick') {
       submitSearch(el.val());
       }
       else {
        el.closest('form').submit();
       }

 //       $('#multi-search').submit();
  }
});
    
    
  }
$('#multi-search').on('submit', function(e) { // if users do not select autocomplete item and instead click search or enter
  e.preventDefault();
  submitSearch($('#dbpage-query').val());
  });
function submitSearch(kw) {
    var dbPatterns = /ebsco$|proquest|academic search complete|films on demand|cinahl|j( )?stor|ethnologue|lex[ui]s(( )?nex[iu]s)?|nexis|gale virtual|gvrl|^cq|onesearch|oxford art|^grove|artstor|ebooks|google scholar|business source|statista|opposing viewpoints|socindex|psycarticles|^eric$|education research complete|greenfile|intelecom|pubmed|medline|naxos|oxford english|oed|rcl|resources for college|science( )?direct|kanopy/i;
    ga('send', 'event', 'search', 'submit', kw);
    if (dbPatterns.test(kw) === true) {
      console.log('found match');
      location.href = 'index.php?az&query=' + encodeURIComponent(kw);
    }
    else {
      var url = 'https://0-search-ebscohost-com.lasiii.losrios.edu/login.aspx?authtype=ip,uid&direct=true&profile=eds&bquery=' + encodeURIComponent(kw) + '&site=eds-live&scope=site';
      if (getCookie('newWindowLinks') === 'yes') {
        window.open(url);
      }
      else {
        location.href = url;
      }
    }
    
  
}
$(function ()
{
  defaultAuto($('#dbpage-query'));
  $('.db-name').each(function ()
  { // correct capitalization while preserving php's sorting
    $(this).text($(this).text().replace('Acls', 'ACLS').replace('Cinahl', 'CINAHL').replace('Cq', 'CQ').replace('Crc', 'CRC').replace('Ebook Coll', 'eBook Coll').replace('Eric', 'ERIC').replace('Medline', 'MEDLINE'));
  });
  // contract nav by default on small screens
  var navList = $('#main-nav');
  var navLabel = $('#nav-label');
  if ($(window).width() < 781)
  {
    navList.addClass('hidden');
  }
  navLabel.on('click', (function ()
  {
    navList.toggleClass('hidden');
  }));
  // if heading has no items listed, hide the entire section - keep this even if getting rid of filters.
  var category = $('.category');
  category.each(function ()
  {
    var e = $(this);
    e.removeClass('active hidden');
    var dbs = e.find('li');
    //  console.log(dbs);
    if (dbs.hasClass('active'))
    {
      e.addClass('active');
    }
    else
    {
      e.addClass('hidden');
    }
  });
  checkZeros();
  // fix borders in last item of lists--can't do this in pure css because of structure of description list
  $('dt').prev('dd').addClass('last-dd');
  // truncate trial database description
  var trialDesc = $('#trial-dbs .db-desc');
  trialDesc.each(function ()
  {
    var a = $(this);
    var desc = a.html();
    // alert(desc);
    var shortText = $.trim(desc).substring(0, 60).split(' ').slice(0, -1).join(' ') + '... <button class="trial-desc-exp" type="button">more</button>';
    a.html(shortText);
    a.show();
    $('.trial-desc-exp').on('click', function ()
    {
      $(this).parent().html(desc);
    });
  });
});
$('#dbpage-query').on('focus', function ()
{
  var button = $(this);
  var remainder = $('#form-remainder');
  showSearch(remainder, button);
  $('html').on('click', function(e) {
    if (!($(e.target).parents('#multi-search').length)) { // clicking outside the form closes it
      if (!(remainder.hasClass('hidden'))) {
        hideSearch(remainder, button);
      }
    }
  });
});
$('.alpha').each(function ()
{
  if ($(this).find('li').length === 0)
  {
    $(this).addClass('hidden');
  }
});

function checkZeros()
{ // if there are no entries at all, show suggestions.
  if ((!($('.problem-description').length)) && (!($('#main .special').length)))
  {
    $('#zero-notice').remove();
    if ($('#main .active').length === 0)
    {
      //   $('.category').removeClass('hidden').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
      var a = $('#main');
      a.append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry!</div>');
      a.append($('#multi-search'));
      $('#dbpage-query').addClass('form-emphasis');
      //   $('#form-remainder').prop('class', 'opened');
      $('#form-remainder').removeClass('hidden');
    }
  }
}
// make search button toggle the search form
function showSearch(form, input)
{
  input.addClass('form-emphasis');
  form.slideDown().removeClass('hidden');
  //    $('#dbpage-query').focus();
  //     input.off(input, 'focus', showSearch);
   $('#dbpage-query-submit').removeClass('hidden');
  $('#form-closer').on('click', (function (e)
  {
    e.preventDefault();
    hideSearch(form, input);
  }));
  //   but.on('click', function() {
  //    hideSearch(form, but);
  //  });

}

function hideSearch(form, input)
{
  $('#dbpage-query-submit').addClass('hidden');
  form.slideUp().addClass('hidden');
  input.removeClass('form-emphasis');
  input.on('click', function ()
  {
    showSearch(form, input);
  });
}
// highlight current page in nav where applicable
$('#main-nav li a').each(function ()
{
  var a = $('#title-cat').text();
  var b = $('#title-alpha').text().toLowerCase();
  var c = $(this);
  var d = c.text();
  if ((a === d) || (b === d))
  {
    c.addClass('current');
  }
});
// do same with format links
$('.format-links').each(function ()
{
  var a = $(this);
  if (a.find('a').text() === $('#title-format').text())
  {
    a.addClass('current');
  }
});


// google analytics events
$('.db-name').on('click', function ()
{
  if (!($(this).attr('target') === '_blank'))
  {
    $('#loader').removeClass('hidden');
  }
  var a = $(this).text();
  ga('send', 'event', 'databases', 'click', a);
});
$('#subject-nav a').on('click', function ()
{
  ga('send', 'event', 'navigation', 'limit', 'subject');
});
$('#alpha-nav a').on('click', function ()
{
  ga('send', 'event', 'navigation', 'limit', 'alpha');
});
$('#show-all').on('click', function ()
{
  ga('send', 'event', 'button', 'click', 'show all');
});
$('.format-links a').on('click', function ()
{
  ga('send', 'event', 'navigation', 'limit', 'type');
});
$('#pubfinder a').on('click', function ()
{
  ga('send', 'event', 'link', 'click', 'Publication Finder');
});
$('#type-filter button').on('click', function ()
{ // is this needed anymore? don't think so
  var a = $(this).text();
  ga('send', 'event', 'filters', 'click', a);
});
$('#dbpage-query').on('focus', function ()
{
  ga('send', 'event', 'search form', 'activate');
});

// cookies
function setCookie(cname, cvalue, exdays)
{
  var expires;
  if (exdays === null) {
    expires = '';
  }
  else {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    expires = 'expires=' + d.toUTCString() + '; ';
  }
  
  document.cookie = cname + '=' + cvalue + '; ' + expires + 'path=/;domain=losrios.edu';
}
$('.headnav a, #choose-library button').on('click', function ()
{ // set home library cookie when people click to their college or select college from menu in box.
  var lib = $(this).text().toLowerCase();
  //  alert(lib);
  setCookie('homeLibrary', lib, 10);
});

function getCookie(cname)
{
  var name = cname + '=';
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++)
  {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
  }
  return '';
}

function homeLibEls(col)
{
  var colProps = {
  	'arc': {
  		cust: 'amerriv',
  		fod: '240535',
  		singleCol: 'a'

  	},
  	'crc': {
  		cust: 'cosum',
  		fod: '237206',
  		singleCol: 'c'

  	},
  	'flc': {
  		cust: 'ns015092',
  		fod: '237742',
  		singleCol: 'f'

  	},
  	'scc': {
  		cust: 'sacram',
  		fod: '106093',
  		singleCol: 's'

  	}
  };
  $('#' + col + '-link').addClass('homelib');
  $.get('help/' + col + '.php', function (data)
  {
    $('#library-help-content').html(data);
  }, 'html');
  var colUpper = col.toUpperCase();
  $('#library-help h2').html('From the ' + colUpper + ' Library');
  $('#pubfinder a').attr('href', 'https://search.ebscohost.com/login.aspx?authtype=ip,guest&direct=true&custid=' + colProps[col].cust + '&db=edspub&groupid=main&profile=eds&plp=1');
  $('.db-entry').each(function() { // hide databases not shown to particular colleges
    var a = $(this);
    if (a.data('college')) {
      if (a.data('college').indexOf(colProps[col].singleCol) === -1) {
        a.hide();
      }
    }
    
  });
  $('.db-name:contains(Films on Demand)').attr('href', 'http://0-fod.infobase.com.lasiii.losrios.edu/PortalPlayLists.aspx?wid=' + colProps[col].fod).data('proxy', true);
  setTimeout(function ()
  {
    $('#library-help-content a').on('click', function ()
    {
      var a = $(this);
      var label;
      if (a.text().length)
      {
        label = a.text();
      }
      else if (a.find('img').length)
      {
        b = a.find('img');
        if (b.attr('alt').length)
        {
          label = b.attr('alt');
        }
        else
        {
          label = '';
        }
      }
      else
      {
        label = '';
      }
      // alert(label);
      ga('send', 'event', '' + col + ' box', 'click', label);
    });
  }, 800);
  showDBNos();
}

function checkCookies(a)
{
  if (a === 'homeLibrary')
  {
    var homeLibrary = getCookie(a);
    if (homeLibrary)
    {
      homeLibEls(homeLibrary);
    
    }
    else
    {
      $.get("help/unknown.php", function (data)
      {
        $('#library-help-content').html(data);
      }, 'html');
      showDBNos();
    }
    console.log(homeLibrary);
  }
  else if (a === 'newWindowLinks')
  {
    var newWins = getCookie(a);
    if (newWins === 'yes')
    {
      $('#newwin-check').prop('checked', true);
      $('.db-name, .headnav a, #pubfinder a, #multi-search').attr('target', '_blank');
      setTimeout(function ()
      {
        $('#library-help-content a').attr('target', '_blank');
      }, 1000);
    }
  }
  else if (a === 'lrGAOptOut') {
    var userPref = getCookie(a);
    if (userPref === 'y') {
      $('#ga-status').prepend(' You have opted out of tracking. ' );
      var optLink = $('#ga-opt-out');
      optLink.html(optLink.html().replace(' &amp; opt out', ''));
    }
  }
}
$('#newwin-check').on('click', function ()
{
  var a = $(this);
  var b = $('.db-name, .search-one-db, #library-help-content a, .headnav a, #pubfinder a');
  if (a.is(':checked'))
  {
    setCookie('newWindowLinks', 'yes', 30);
    b.attr('target', '_blank');
    if ($('#search-db').prop('checked', false))
    {
      $('#multi-search').attr('target', '_blank');
    }
  }
  else
  {
    setCookie('newWindowLinks', 'no', 1);
    b.removeAttr('target');
    $('#multi-search').removeAttr('target');
  }
});
checkCookies('homeLibrary');
checkCookies('newWindowLinks');
checkCookies('lrGAOptOut');
$('#choose-library button').on('click', (function ()
{
    $('script[src*="libraryh3lp"]').remove();
    $('.zopim').remove();
    $('.db-entry').show();
  var library = $(this).text();
  /*
  $.get("help/" + library + ".php", function(data) {
    $("#library-help-content").html(data);
  }, 'html');
  setCookie('homeLibrary', library, 20);
  var colUpper = library.toUpperCase();
    $('#library-help h2').html('From the '+colUpper + ' Library');
    */
  homeLibEls(library);
}));
var currentURL = location.href;
// var pagePath = '/tools/databases/library/tools/databases';
if (currentURL.match('college='))
{
  currentURL = currentURL.replace(/(\?|&)college.*/, '');
  replaceURL = currentURL.replace(/.*losrios.edu\//, '');
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
$('.open-db-search').on('click', function ()
{
  var searchButton = $(this);
  var target = '';
  var winSetting = getCookie('newWindowLinks');
  if (winSetting === 'yes')
  {
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
  $('.open-db-search').removeClass('hidden');
  var searchForms = $('.search-one-db');
  if (!dbEl)
  { // this is causing problem on main categories page when database is listed twice... if one is used and then you try another, the element already exists but elsewhere. Does it matter?
    searchForms.hide();
    var dbURL = dbName.attr('href');
    var ehost = '';
    if (dbURL.indexOf('ehost') > -1)
    {
      var ebCode = dbURL.split(/[= ]+/).pop();
      ehost = '<input type="hidden" name="ehost" value="' + ebCode + '">';
    }
    var searchDB = '<form onsubmit="ga(\'send\', \'event\', \'quick search\', \'submit\', \'' + dbNameText + '\');" class="search-one-db" method="post" action="search-db.php" ' + target + '><label class="search-one-db-l" for="' + dbNameLower + '">Search ' + dbNameText + '</label><input name="query" id="' + dbNameLower + '" type="text"><input type="hidden" name="vendor" value="' + vendor + '"><input type="hidden" name="db-name" value="' + dbNameLower + '">' + ehost + '<button class="search-btn" type="submit"><img height="16" width="16" src="search.png" alt="search"></button></form>';
    searchButton.addClass('hidden');
    searchButton.after(searchDB);
    searchButton.next(searchForms).fadeIn();
    var input = searchButton.next(searchForms).find(':text');
    input.focus();
    defaultAuto(input, 'quick');
  }
  else
  {
    searchButton.addClass('hidden');
    searchForms.hide();
    searchButton.next(searchForms).fadeIn();
    document.getElementById(dbNameLower).focus();
  }
});

$('#ga-opt-out').on('click', function(e) {
  e.preventDefault();
  var sHeight = screen.availHeight;
  var winHeight = sHeight * 0.7;
  var topOffset = sHeight * 0.15;
  var sWidth = screen.width;
  var winWidth = 700;
  var leftOffset = (sWidth/2) - (winWidth/2);
  var optPage = $(this).attr('href');
  var optOutWin = window.open(optPage, 'optOut', 'height=' + winHeight + ', width=' + winWidth + ', menubar=no, left='+ leftOffset + ', top=' + topOffset + '');
  optOutWin.focus();
  });
$('#remove-proxy').on('click', function() {
  removeProxy();
  setCookie('dbProxy', 'removed', null);
  
  
});
$('#add-ezproxy').on('click', function() {
	if ($('body').data('ezproxy') !== true) {
		removeProxy();
		$('#proxy').hide();
    var proxyPref = 'https://ezproxy.losrios.edu/login?url=';
		$('.db-name').each(function() {
			if ($(this).data('proxy') !== false) {
				var h = $(this).attr('href');
				var deProxy = h.replace(/^/, proxyPref);
				$(this).attr('href', deProxy);
			}
      else if ($(this).attr('href').indexOf('special') > -1) {
        var arr = $(this).attr('href').split('=');
        var url = arr.pop();
        $(this).attr('href', proxyPref + url);
      }
		});
		$('body').data('ezproxy', true);
		if (!($('#ez-proxy-explanation').length)) {
			$('#add-ezproxy').after('<p class="special">This is for testing access via the new authentication system. Not all databases will function correctly. To go back to the normal urls, refresh the screen or navigate to another page.</p>');
		}
	}
});
var proxySet = getCookie('dbProxy');
if (proxySet === 'removed') {
  removeProxy();
}
function removeProxy() {
    $('.db-name').each(function() {
    var h = $(this).attr('href');
    if (h.indexOf('//0-') > -1) {
     var deProxy = h.replace('//0-', '//');
     if (h.indexOf('https') > -1) {
      var parts = deProxy.split('.edu/');
      parts[0] = parts[0].replace(/\-/g, '.').replace(/$/, '.edu/');
      deProxy = parts.join('');
      console.log(deProxy);
     }
     deProxy = deProxy.replace('.lasiii.losrios.edu', '');
     $(this).attr('href', deProxy); 
    }
  });
    var proxyDiv = $('#proxy');
  $('#remove-proxy').attr('id', 'add-proxy').html('&#8635; Restore proxy string to URLs');
  $('<p class="special">Proxy string has been removed from URLs; databases may not be accessible.</p>').hide().prependTo(proxyDiv).fadeIn();
  $('#add-proxy').on('click', function() {
    setCookie('dbProxy', 'restored', null);
    proxyDiv.find('p').remove();
    proxyDiv.fadeOut('fast');
    location.reload();
  });
}