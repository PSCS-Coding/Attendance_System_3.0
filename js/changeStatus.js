function frontPageButtons(id) {
  if ($('#'+id+' .status').html().startsWith('Present')) {
    $('#'+id).find('.status-button').hide();
  }
  else if ($('#'+id+' .status').html().startsWith('Not')) {
    $('#'+id).find('.absent, .present, .late').show();
    $('#'+id).find('.checked-out').hide();
  }
  else if ($('#'+id+' .status').html().startsWith('Off')) {
    $('#'+id).find('.status-button').hide();
    $('#'+id).find('.present').show();
  }
  else if ($('#'+id+' .status').html().startsWith('Field')) {
    $('#'+id).find('.status-button').hide();
    $('#'+id).find('.present').show();
  }
  else if ($('#'+id+' .status').html().startsWith('Late')) {
    $('#'+id).find('.absent, .present, .late').show();
    $('#'+id).find('.checked-out').hide();
  }
  else if ($('#'+id+' .status').html().startsWith('Independent')) {
    $('#'+id).find('.status-button').hide();
    $('#'+id).find('.present').show();
  }
  else if ($('#'+id+' .status').html().startsWith('Absent')) {
    $('#'+id).find('.status-button').hide();
  }
  else if ($('#'+id+' .status').html().startsWith('Checked')) {
    $('#'+id).find('.status-button').hide();
  }
}

$('.student-row input:submit').click( function() {
  var student_id = $(this).closest("tr").prop("id");
  var status_id = $(this).attr('name');
  var return_time = 0;
  if (status_id == 5) {
    var return_time = $(this).siblings('.late-time').val();
  }

    $.ajax({
      type:"POST",
      data:{student:student_id,status:status_id,time:return_time},
      dataType: "text",
      url:"change_status.php",
      success: function(result){
        $('#'+student_id+' .status').html(result);
        if (status_id == 7 || status_id == 1) { // if absent or present, hide the other buttons
          $('#'+student_id+' td').children('.absent, .present, .late, .checked-out').hide();
        }
      }
    });
    return false; // not sure if this is needed

});
