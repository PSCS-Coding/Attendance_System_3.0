$('.student-row input').click( function() {
  var student_id = $(this).closest("tr").prop("id");
  var status_id = $(this).attr('name');
  var return_time = 0;
  /*if(status_id == 5){
  	var return_time = $(this).closest("td").find("input[name=`time`]").val();
}*/
  $.ajax({
    type:"POST",
    data:{student:student_id,status:status_id,time:return_time},
    dataType: "text",
    url:"change_status.php",
    success: function(result){
      $('#'+student_id+' .status').html(result);
    }
  });
  return false; // not sure if this is needed

});
