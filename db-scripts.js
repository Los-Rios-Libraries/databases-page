     // db autocomplete
      var dbNames = ["Academic Search Complete", "ACLS Humanities E-Book", "America: History and Life with Full Text", "Artstor", "Auto Repair Reference Center", "BIR Entertainment", "Book Index with Reviews", "Business Source Complete", "CINAHL Plus with Full Text", "Communication & Mass Media Complete", "Consumer Health Complete", "CountryWatch", "CQ Researcher", "Criminal Justice Abstracts with Full Text", "Data-Planet", "eBook Collection", "Ebooks", "EBSCO", "Education Research Complete", "Environment Complete", "ERIC", "Explora", "Gale", "Gale Virtual Reference Library", "Google Scholar", "GreenFILE", "Health Source: Consumer Edition", "Health Source: Nursing/Academic Edition", "International Bibliography of Theatre & Dance with Full Text", "JSTOR", "LexisNexis Academic", "Library, Information Science & Technology Abstracts", "Literary Reference Center Plus", "MasterFILE Premier", "MEDLINE", "Military & Government Collection", "Naxos Music Library", "Naxos Music Library Jazz Collection", "News", "Newspaper Source Plus", "OneSearch", "Opposing Viewpoints in Context", "Oxford English Dictionary", "PsycARTICLES", "Psychology & Behavioral Sciences Collection", "PubMed", "Regional Business News", "Religion & Philosophy Collection", "Salem Press", "Small Business Reference Center", "ScienceDirect", "Scholarly Journals", "SocINDEX with Full Text", "Statista", "Trade Publications"];

$(function ()
{
  var dbNo = $('#main .db-name').length;
  var numberDisplay = $('#show-db-no');
  if (dbNo < 70)
  {
    dbNoS = dbNo.toString();
    $('#db-no').text(dbNoS);
    if (dbNo === 1)
    {
      numberDisplay.text(numberDisplay.text().replace('Databases', 'Database'));
    }
    numberDisplay.attr('class', 'show');
  }
  else
  {
    numberDisplay.attr('class', 'hidden').attr('aria-hidden', 'true');
  }
  $('.db-name').each(function ()
  { // correct capitalization while preserving php's sorting
    $(this).text($(this).text().replace('Acls', 'ACLS').replace('Cinahl', 'CINAHL').replace('Cq', 'CQ').replace('Ebook Coll', 'eBook Coll').replace('Eric', 'ERIC').replace('Medline', 'MEDLINE'));
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
  //   var button = $(this);
  //   var searchForm = $('#multi-search');
  showSearch($('#form-remainder'), $(this));
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
  if (!($('.problem-description').length))
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
  $('#form-closer').on('click', (function (e)
  {
    e.preventDefault();
    hideSearch(form, input);
  }));
  //   but.on('click', function() {
  //    hideSearch(form, but);
  //  });
  $('#search-db').on('click', function() {
  $("#dbpage-query").autocomplete(
  {
    
    source: function (request, response)
    {
 
      var results = $.ui.autocomplete.filter(dbNames, request.term);
      response(results.slice(0, 5));
    },
    /*    source: function(request, response) {
      var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
      response($.grep(dbNames, function(item) {
        return matcher.test(item);
      }));
    },*/
    select: function (event, ui)
    {
      if (ui.item)
      {
        $(this).val(ui.item.value);
      }
      $('#multi-search').submit();
    }
  });
  });
}

function hideSearch(form, input)
{
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
// show hints for different search options
$('#multi-search input[type=radio]').on('click', function ()
{
  var form = $('#multi-search');
  $('.search-exp').each(function ()
  {
    e = $(this);
    if (!(e.hasClass('hidden')))
    {
      e.slideUp().addClass('hidden');
    }
  });
  a = $(this);
  b = $('#dbpage-query');
  checkCookies();
  var newWins = getCookie('newWindowLinks');
  if (newWins === 'yes')
  {
    form.attr('target', '_blank');
  }
  if (a.is('#search-db'))
  {
    form.removeAttr('target');
    b.autocomplete(
    {
      disabled: false,
      source: dbNames,
      select: function (event, ui)
      {
        if (ui.item)
        {
          b.val(ui.item.value);
        }
        //      alert('hello');
        form.submit();
      }
    });
  }
  else
  {
    b.autocomplete(
    {
      disabled: true
    });
  }
  a.parent().next().slideDown().removeClass('hidden');
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
$('#multi-search').on('submit', function ()
{
  var a = $('input[name="search-type"]:checked').val();
  var searchTerm = $('#dbpage-query').val();
  ga('send', 'event', 'search', 'submit - ' + a, searchTerm);
});
// cookies
function setCookie(cname, cvalue, exdays)
{
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = 'expires=' + d.toUTCString();
  document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/;domain=losrios.edu';
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
  var cust;
  switch (col)
  {
  case 'arc':
    cust = 'amerriv';
    break;
  case 'scc':
    cust = 'sacram';
    break;
  case 'crc':
    cust = 'cosum';
    break;
  case 'flc':
    cust = 'ns015092';
    break;
  default:
    cust = '';
  }
  $('#' + col + '-link').addClass('homelib');
  $.get('help/' + col + '.php', function (data)
  {
    $('#library-help-content').html(data);
  }, 'html');
  var colUpper = col.toUpperCase();
  $('#library-help h2').html('From the ' + colUpper + ' Library');
  $('#pubfinder a').attr('href', 'http://search.ebscohost.com/login.aspx?authtype=ip,guest&direct=true&custid=' + cust + '&db=edspub&groupid=main&profile=eds&plp=1');
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
}

function checkCookies(a)
{
  if (a === 'homeLibrary')
  {
    var homeLibrary = getCookie(a);
    if (homeLibrary === 'arc')
    {
      homeLibEls('arc');
    }
    else if (homeLibrary === 'scc')
    {
      homeLibEls('scc');
    }
    else if (homeLibrary === 'crc')
    {
      homeLibEls('crc');
    }
    else if (homeLibrary === 'flc')
    {
      homeLibEls('flc');
    }
    else
    {
      $.get("help/unknown.php", function (data)
      {
        $('#library-help-content').html(data);
      }, 'html');
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
$('#choose-library button').on('click', (function ()
{
    $('script[src*="libraryh3lp"]').remove();
    $('.zopim').remove();
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
    searchButton.next(searchForms).find(':text').focus();
  }
  else
  {
    searchButton.addClass('hidden');
    searchForms.hide();
    searchButton.next(searchForms).fadeIn();
    document.getElementById(dbNameLower).focus();
  }
});
/*
// hide crc chat
function hideZ()
{
  $('.zopim').addClass('hidden');
}

function showZ()
{
  $('.zopim').removeClass('hidden');
}
*/