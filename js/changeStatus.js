$('.student-row input').click( function() {
  var student_id = $(this).closest("tr").prop("id");
  var status_id = $(this).attr('name');
  var my_button = this;

  $.ajax({
    type:"POST",
    data:{student:student_id,status:status_id},
    dataType: "text",
    url:"change_status.php",
    success: function(result){
      $('#'+student_id+' .status').html(result);
      // $('#result').html(result);
    }
  });
  return false;

});
