//navbar creator
var getUserData = function () {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "../backend/userinfo.php", false);
    xmlHttp.send(null);
    return xmlHttp.responseText;
};

function createNav() {
    var userdata = getUserData();
    if (userdata.includes("admin") && userdata.includes("~!@#$%^&")) {
        userdata = userdata.split("~!@#$%^&");
        $(".navpic").attr("src", userdata[3]);
        $(".navname").text(userdata[0] + " " + userdata[1]);
        $(".navuserhome").attr("href", "/admin");
        $(".navuserhome").text("Admin");
        $(".achievments").attr("hidden", "true");
        $(".featbadge").html(
            '<span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="Admin user"><i class="fas fa-key"></i></span></span>'
        );
    } else if (userdata.includes("~!@#$%^&")) {
        userdata = userdata.split("~!@#$%^&");
        $(".navpic").attr("src", userdata[3]);
        $(".navname").html(userdata[0] + " " + userdata[1]);
        $(".navuserhome").attr("href", "/home.php");
        $(".navuserhome").text("Home");
        if (userdata[4] == 1) {
            $(".featbadge").html(
                '<span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="System developer"><i class="fas fa-code"></i></span></span>'
            );
        }
    } else if (userdata == "password") {
        $(".navuserdropdown").attr("hidden", "true");
        $(".navuserhome").attr("href", "/login/?out=true");
        $(".navuserhome").text("Log out");
    }
}