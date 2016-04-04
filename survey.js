var desire = getCookie('dbSurvey');
if (desire !== 'no')
{
  setTimeout(function ()
  {
    /*
        var survey = document.createElement('div');
        survey.id = 'survey';
        survey.setAttribute('role', 'alert');
        survey.innerHTML = '<p>The Library is trying to improve this page. Would you help us by answering a few survey questions?</p><div id="survey-buttons"><button class="survey-button" id="survey-yes" type="button" onclick="surveyChoice(\'yes\')">Yes</button><button class="survey-button" id="survey-no" type="button" onclick="surveyChoice(\'no\')";>Not today</button><button class="survey-button" id="survey-never" type="button" onclick="surveyChoice(\'never\')">No, don\'t show this again.</button></div>';
        document.getElementById('main').appendChild(survey);
        */
    var surveyContent = '<div id="survey" role="alert" style="display:none;"><button type="button" id="close-survey" aria-label="close">x</button><p>The Library is trying to improve this page. Would you help us by answering a few questions?</p><div id="survey-buttons"><button class="survey-button" id="survey-yes" type="button" onclick="surveyChoice(\'yes\')">Yes</button><button class="survey-button" id="survey-no" type="button" onclick="surveyChoice(\'no\')";>Not today</button><button class="survey-button" id="survey-never" type="button" onclick="surveyChoice(\'never\')">No, don&#8217;t show this again</button></div></div>';
    $('body').append(surveyContent);
    var s = $('#survey');
    s.slideDown();
    $('#close-survey').on('click', function ()
    {
      console.log('clicked');
      s.slideUp();
      createSurveyLink();
    });
  }, 7000);
}
else
{
  createSurveyLink();
}

function createSurveyLink()
{
  var surveAside = '<aside id="survey-link" class="gen-aside" style="display:none;"><p><a onclick="ga(\'send\', \'event\', \'survey\', \'opt-in\');" href="https://docs.google.com/forms/d/1_HUVvlT1tUUW0pX_BV0o500cZ7vK6lTmDH3aSoWcvuk/viewform">Take our survey!</a></p></aside>';
  $('body').append(surveAside);
  $('#survey-link').fadeIn(1200);
}

function surveyChoice(d)
{
  var s = $('#survey');
  if (d === 'yes')
  {
    s.fadeOut();
    var sURL = 'https://docs.google.com/forms/d/1_HUVvlT1tUUW0pX_BV0o500cZ7vK6lTmDH3aSoWcvuk/viewform';
    var newWins = getCookie('newWindowLinks');
    if (newWins === 'yes') {
        window.open(sURL);
    }
    else {
    $('#loader').removeClass('hidden');
    location.href = sURL;
    }
    setCookie('dbSurvey', 'no', 30);
    ga('send', 'event', 'survey', 'opt-in');
  }
  else if (d === 'no')
  {
    setCookie('dbSurvey', 'no', 1);
    ga('send', 'event', 'survey', 'opt-out', 'temporary');
    s.slideUp();
    createSurveyLink();
  }
  else if (d === 'never')
  {
    setCookie('dbSurvey', 'no', 30);
    ga('send', 'event', 'survey', 'opt-out', 'permanent');
    s.slideUp();
    createSurveyLink();
  }
}