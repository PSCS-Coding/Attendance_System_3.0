//navbar creator
var getUserData = function() {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "/userinfo.php", false);
    xmlHttp.send(null);
    return (xmlHttp.responseText);
}

function createNav() {
  $('.card.bg-dark').width($('.test').width());
	$('.card.bg-dark').height($('.test').height());
	$('.flip-container').width($('.test').width());
	$('.flip-container').height($('.test').height());
	$('.back').width($('.test').width());
	$('.back').height($('.test').height());
  var userdata = getUserData();
  if(userdata.includes('admin') && userdata.includes('~')) {
    userdata = userdata.split("~");
    $('.navpic').attr('src', userdata[3]);
    $('.navname').text(userdata[0] + ' ' + userdata[1]);
    $('.navuserhome').attr('href','/admin');
    $('.navuserhome').text('Admin');
    $('.achievments').attr('hidden', 'true');
    $('.featbadge').html('<span class="badge badge-secondary"><i class="fas fa-edit"></i></span></span>');
  } else if(userdata.includes('~')) {
    userdata = userdata.split("~");
    $('.navpic').attr('src', userdata[3]);
    $('.navname').text(userdata[0] + ' ' + userdata[1]);
    $('.navuserhome').attr('href','/home.php');
    $('.navuserhome').text('Home');
    if(userdata[4] == 1) {
      $('.featbadge').html('<span class="badge badge-secondary"><i class="fas fa-code"></i></span></span>');
    }
  } else if(userdata == 'password') {
    $('.navuserdropdown').attr('hidden', 'true');
  }
}
window.onload = createNav;
