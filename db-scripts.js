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
var typeButtons = $('#type-filter button');
typeButtons.on('click', function() {
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

});
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
  if ($('#main .active').length === 0) {
    //   $('.category').removeClass('hidden').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
    $('#main').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
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

$('#multi-search input[type=radio]').on('click', function() {

$('.search-exp').each(function() {
    e = $(this);
    if (!(e.hasClass('hidden'))) {
        e.slideUp().addClass('hidden');
    }
    });
$(this).parent().next().slideDown().removeClass('hidden');
    
});