
  $('#sub').click(function () {
    var student = $('#student').val();
    var status = $('#status').val();
    $.ajax({
      type:'POST',
      data:{student:student,status:status},
      url:"insert.php",
      success: function(result){
        $('#result').html(result);
      }
    });
    return false;
  });




// $("#sub").click( function() {
//     $.post (
//       $("testform").attr("action"),
//       $("#testform :input").serializeArray(),
//       function(info) {
//         $("#result").html(info);
//       });
//     clearInput();
//     return false;
// });
//
// // Don't redirect after the user submits
// $("#testform").submit( function() {
//   return false;
// });

function clearInput() {
  $("#testform :input").each( function() {
    $(this).val('');
  });
}
