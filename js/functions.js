function query(fn, id) {
  var url = '/request.php?f=';
  if(id) {
    url += (fn + '&id=' + id);
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
    return (JSON.parse(data));
}
