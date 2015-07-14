$(function() {
var dbNo = $('.db-name').length;
var numberDisplay = $('#show-db-no');

if (dbNo < 70) {

dbNoS = dbNo.toString();
$('#db-no').text(dbNoS);
if (dbNo === 1) {
  numberDisplay.text(numberDisplay.text().replace('Databases', 'Database'));  
}
numberDisplay.attr('class', 'show');
}
else {
  numberDisplay.attr('class', 'hidden').attr('aria-hidden', 'true');
}

$('.db-name').each(function() { // correct capitalization while preserving php's sorting
    $(this).text($(this).text().replace('Cinahl', 'CINAHL').replace('Cq', 'CQ').replace('Ebook Coll', 'eBook Coll').replace('Eric', 'ERIC').replace('Medline', 'MEDLINE'));

    
});
});


$(function() {
// contract nav by default on small screens
var navList = $('#main-nav');
var navLabel = $('#nav-label');
if ($(window).width() < 781) {
  navList.addClass('hidden');
}

navLabel.on('click', (function() {
navList.toggleClass('hidden');
}));

});

$(function() {
// filters -- probably should not use this
/*
var typeButtons = $('#type-filter button');
typeButtons.on('click', function() {
    $('#zero-notice').remove();
  typeButtons.removeClass('active'); // reset all before doing it. This is a toggle, not a progressive limit. Set is too small for hta tto make sense.
  $(this).prop('class', 'active');
  var buttonText = $(this).text();
  buttonText = buttonText.replace(' ', '-');
  buttonText = buttonText.toLowerCase();
  $('#main .category li').each(function() {
    var e = $(this);
    e.removeClass('active hidden');
    if (e.hasClass(buttonText)) {
      e.addClass('active');
    } else {
      e.addClass('hidden');
    }
  });
*/

  // if heading has no items listed, hide the entire section - keep this even if getting rid of filters.
  var category = $('.category');
  category.each(function() {
    var e = $(this);
    e.removeClass('active hidden');
    var dbs = e.find('li');
    //  console.log(dbs);
    if (dbs.hasClass('active')) {
      e.addClass('active');
    } else {
      e.addClass('hidden');
    }

  });
  checkZeros();

// });
});
$('.alpha').each(function() {
  if ($(this).find('li').length === 0) {
    $(this).addClass('hidden');
  }
});

$(function() { // need to do this on every page load.
checkZeros();
});
function checkZeros() { // if there are no entries at all, show suggestions.
 $('#zero-notice').remove();
  if ($('#main .active').length === 0) {
    //   $('.category').removeClass('hidden').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
    var a = $('#main');


    
    a.append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry!</div>');

    a.append($('#multi-search'));
 //   $('#form-remainder').prop('class', 'opened');
 $('#form-remainder').removeClass('hidden');
  }
}

$(function() { // fix borders in last item of lists--can't do this in pure css because of structure of description list
  $('dt').prev('dd').addClass('last-dd');
});

$(function() {
// show hints for different search options
$('#dbpage-query').on('focus', function() {
//   var button = $(this);
 //   var searchForm = $('#multi-search');
   showSearch($('#form-remainder'), $(this));
 
});
});

// make search button toggle the search form
function showSearch(form, input) {
input.addClass('form-emphasis');
    form.slideDown().removeClass('hidden');
//    $('#dbpage-query').focus();
     input.unbind();
     $('#form-closer').on('click', (function(e) {
        e.preventDefault();
        hideSearch(form,input);
        
     }));
//   but.on('click', function() {
//    hideSearch(form, but);
 //  });
}
function hideSearch(form, input) {
    form.slideUp().addClass('hidden');
    input.removeClass('form-emphasis');
    input.on('click', function() {
        showSearch(form, input);
    });
    
}

// highlight current page in nav where applicable
$('#main-nav li a').each(function() {
    var a = $('#title-cat').text();
    var b = $('#title-alpha').text().toLowerCase();
    var c = $(this);
    var d = c.text();
    if ((a === d) || (b === d)) {
        c.addClass('current');
    }
    });

// do same with format links
$('.format-links').each(function() {
   var a = $(this);
   if (a.find('a').text() === $('#title-format').text()) {
    a.addClass('current');
   }
   
});
$('#multi-search input[type=radio]').on('click', function() {

$('.search-exp').each(function() {
    e = $(this);
    if (!(e.hasClass('hidden'))) {
        e.slideUp().addClass('hidden');
    }
    });
$(this).parent().next().slideDown().removeClass('hidden');
    
});

// google analytics events
$('.db-name').on('click', function() {
    var a = $(this).text();
  ga('send', 'event', 'databases', 'click', a);
});

$('#subject-nav a').on('click', function() {
  ga('send', 'event', 'navigation', 'limit', 'subject');
});
$('#alpha-nav a').on('click', function() {
  ga('send', 'event', 'navigation', 'limit', 'alpha');
});
$('#show-all').on('click', function() {
  ga('send', 'event', 'button', 'click', 'show all');
});
$('#type-filter button').on('click', function() {
    var a = $(this).text();
  ga('send', 'event', 'filters', 'click', a);
});
$('#dbpage-query').on('focus', function() {
  ga('send', 'event', 'search form', 'activate');
});

$('#multi-search').on('submit', function() {
  var a = $('input[name="search-type"]:checked').val();
  var searchTerm = $('#dbpage-query').val();
  ga('send', 'event', 'search', 'submit - ' + a, searchTerm);
});


// cookies
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = 'expires='+d.toUTCString();
    document.cookie = cname + '=' + cvalue + '; ' + expires;
}

$('.headnav a').on('click', function() { // set home library cookie when people click to their college.
    var lib = $(this).text().toLowerCase();
   setCookie('homeLibrary', lib, 10);
   alert(lib);
});


function getCookie(cname) {
    var name = cname + '=';
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) === 0) return c.substring(name.length,c.length);
    }
    return '';
}

function checkCookie() {
    var homeLibrary=getCookie('homeLibrary');
    if (homeLibrary==='arc') {

      $('#arc-link').addClass('homelib');
      }
      else if (homeLibrary === 'scc') {
      $('#scc-link').addClass('homelib');
      }
      else if (homeLibrary === 'crc') {
      $('#crc-link').addClass('homelib');
      }
      else if (homeLibrary === 'flc') {
      $('flc-link').addClass('homelib');
      }
      else{
        
    }
    console.log(homeLibrary);

}
checkCookie();
