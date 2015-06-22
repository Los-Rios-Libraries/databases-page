// contract nav by default on small screens
var navList = $('#main-nav');
var navLabel = $('#nav-label');
if ($(window).width() < 781) {
  navList.addClass('hidden');
}

navLabel.on('click', (function() {

  if (navList.hasClass('hidden')) {
    navList.removeClass('hidden');
  } else navList.addClass('hidden');

}));
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

  // if heading has no items listed, hide the entire section
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
$('.alpha').each(function() {
  if ($(this).find('li').length === 0) {
    $(this).addClass('hidden');
  }
});


checkZeros();

function checkZeros() { // if there are no entries at all, show suggestions.
  if ($('#main .active').length === 0) {
    //   $('.category').removeClass('hidden').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
    $('#main').append('<div id="zero-notice">There are no databases fitting the criteria you indicated. Sorry! Try again?</div>');
  }
}
// fix borders in last item of lists--can't do this in pure css because of structure of description list
$(function() {
  $('dt').prev('dd').addClass('last-dd');
});

function searchFeature() {

 //   if (search.parent('body')) {
        //code
    var element = $('#source-search').detach();
    element.css('float', 'none');
    element.css('width', '80%');
    $('#main nav').append(element);
    
//}
}
// show hints for different search options
$('#open-search').on('click', function() {
//   var button = $(this);
 //   var searchForm = $('#multi-search');
   showSearch($('#multi-search'), $(this));
  
   
   
    
});
function showSearch(form, but) {

    form.slideDown().removeClass('hidden');
    $('#dbpage-query').focus();
     but.unbind();
   but.on('click', function() {
    hideSearch(form, but);
   });
}
function hideSearch(form, but) {
    form.slideUp().addClass('hidden');
    but.unbind();
    but.on('click', function() {
        showSearch(form, but);
    });
    
}

$('#multi-search input[type=radio]').on('click', function() {
//   $('<p>whatever</p>').fadeIn().insertAfter($(this).next());
$('.search-exp').each(function() {
    e = $(this);
    if (!(e.hasClass('hidden'))) {
        e.slideUp().addClass('hidden');
    }
    });
$(this).parent().next().slideDown().removeClass('hidden');
    
});