$('.student-row input').click( function() {
  var student_id = $(this).closest("tr").prop("id");
  var status_id = $(this).attr('name');

  $.ajax({
    type:"POST",
    data:{student:student_id,status:status_id},
    dataType: "text",
    url:"change_status.php",
    success: function(result){
      $('#'+student_id+' .status').html(result);
    }
  });
  return false; // not sure if this is needed

});
