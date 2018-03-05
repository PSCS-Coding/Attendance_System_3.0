$('.student-row input').click( function() {
  var student_id = $(this).closest("tr").prop("id");
  var status_id = $(this).attr('name');
  alert(status_id);

  $.ajax({
    type:"POST",
    data:{student:student_id,status:status_id},
    dataType: "text",
    url:"insert.php",
    success: function(result){
      $('#result').html(result);
    }
  });
  return false;

});
