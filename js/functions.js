function query(fn, id) {
    var url = "../backend/request.php?f=";
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
        success: function (result) {
            data = result;
        }
    });
    return JSON.parse(data);
}

function facilitatorNameToId(name) {
    var url = "../backend/request.php?f=facilitatorNameToId";
    url += "&facilitator=" + name;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function (result) {
            data = result;
        }
    });
    return JSON.parse(data);
}

function locationNameToId(name) {
    var url = "../backend/request.php?f=locationNameToId";
    url += "&location=" + name;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function (result) {
            data = result;
        }
    });
    return JSON.parse(data);
}

function studentNameToId(fname, lname) {
    var url = "../backend/equest.php?f=studentNameToId";
    url += "&fname=" + fname + "&lname=" + lname;

    var data = "";

    $.ajax({
        type: "GET",
        data: {},
        async: false,
        dataType: "text",
        url: url,
        success: function (result) {
            data = result;
        }
    });
    return JSON.parse(data);
}

function changeStatus(student_ids, status_id, info, return_time) {
    var url = "../backend/request.php?f=changeStatus";
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
        success: function (result) {
            data = result;
        }
    });
    return 1;
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function isCheckedById(id) {
    alert(id);
    var checked = $("input[@id=" + id + "]:checked").length;
    alert(checked);

    if (checked == 0) {
        return false;
    } else {
        return true;
    }
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}