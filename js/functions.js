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
