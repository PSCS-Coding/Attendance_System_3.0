//navbar creator
var getUserData = function() {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "/userinfo.php", false);
    xmlHttp.send(null);
    return (xmlHttp.responseText);
}

function createNav() {
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
    $('.navname').html(userdata[0] + ' ' + userdata[1]);
    $('.rep').html('<a class="dropdown-item disabled" style="cursor:default;color:#6c757d"> Current rep: <span style="font-weight:bold;color:black">' + userdata[5] + '</span></a>');
    $('.navuserhome').attr('href','/home.php');
    $('.navuserhome').text('Home');
    if(userdata[4] == 1) {
      $('.featbadge').html('<span class="badge badge-secondary"><i class="fas fa-code"></i></span></span>');
    }
  } else if(userdata == 'password') {
    $('.navuserdropdown').attr('hidden', 'true');
    $('.navuserhome').attr('href', '/login/?out=true');
    $('.navuserhome').text('Log out');
  }
}
