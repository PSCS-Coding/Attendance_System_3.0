function query(fn, id) {
    var url = "../request.php?f=";
    if (id) {
        url += fn + "&id=" + id;
    } else {
        url += fn;
    }

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function(result) {
            data = result;
        }
    });
    return JSON.parse(data);
}
function facilitatorNameToId(name) {
    var url = "../request.php?f=facilitatorNameToId";
    url += "&facilitator=" + name;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function(result) {
            data = result;
        }
    });
    return JSON.parse(data);
}
function locationNameToId(name) {
    var url = "../request.php?f=locationNameToId";
    url += "&location=" + name;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function(result) {
            data = result;
        }
    });
    return JSON.parse(data);
}
function studentNameToId(fname, lname) {
    var url = "../request.php?f=studentNameToId";
    url += "&fname=" + fname + "&lname=" + lname;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function(result) {
            data = result;
        }
    });
    return JSON.parse(data);
}
function changeStatus(student_ids, status_id, info, return_time) {
    var url = "../request.php?f=changeStatus";
    url +=
        "&student_id=" +
        student_ids +
        "&status_id=" +
        status_id +
        "&info=" +
        info +
        "&return_time=" +
        return_time;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function(result) {
            data = result;
        }
    });
    return 1;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
