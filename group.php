<!DOCTYPE html>
<html>
  <head>
    <title>Group Edit View</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>jQuery UI Droppable - Simple photo manager</title>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <style>
	  #gallery { float: left; width: 65%; min-height: 12em; }
	  .gallery.custom-state-active { background: #eee; }
	  .gallery li { float: left; width: 96px; padding: 0.4em; margin: 0 0.4em 0.4em 0; text-align: center; }
	  .gallery li h5 { margin: 0 0 0.4em; cursor: move; }
	  .gallery li a { float: right; }
	  .gallery li a.ui-icon-zoomin { float: left; }
	  .gallery li img { width: 100%; cursor: move; }

	  #trash { float: right; width: 32%; min-height: 18em; padding: 1%; }
	  #trash h4 { line-height: 16px; margin: 0 0 0.4em; }
	  #trash h4 .ui-icon { float: left; }
	  #trash .gallery h5 { display: none; }
	  </style>
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <script>
	  $( function() {

	    // There's the gallery and the trash
	    var $gallery = $( "#gallery" ),
	      $trash = $( "#trash" );

	    // Let the gallery items be draggable
	    $( "li", $gallery ).draggable({
	      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
	      revert: "invalid", // when not dropped, the item will revert back to its initial position
	      containment: "document",
	      helper: "clone",
	      cursor: "move"
	    });

	    // Let the trash be droppable, accepting the gallery items
	    $trash.droppable({
	      accept: "#gallery > li",
	      classes: {
	        "ui-droppable-active": "ui-state-highlight"
	      },
	      drop: function( event, ui ) {
	        deleteImage( ui.draggable );
	      }
	    });

	    // Let the gallery be droppable as well, accepting items from the trash
	    $gallery.droppable({
	      accept: "#trash li",
	      classes: {
	        "ui-droppable-active": "custom-state-active"
	      },
	      drop: function( event, ui ) {
	        recycleImage( ui.draggable );
	      }
	    });


		$("html").on("drop", function(event) {
    		event.preventDefault();
    		event.stopPropagation();
			alert("Dropped!");
			  	var $student_id = $(this).siblings('input').val();
				var $group_name = "volleyball";

				$.ajax({
					type:"POST",
					data:{student:student_id,group:group_name},
					dataType: "text",
					url:"backend/addtogroup.php"
			    });
		});

	  } );
	  </script>
	</head>
	<body class="top">
      <?php
      	require_once("connection.php");
  		$query = "SELECT first_name, last_name, student_id FROM student_data WHERE active = 1";
  		$values = $db->query($query)->fetch_all($restablettype = MYSQLI_ASSOC);
  		$foo = count($values);
      ?>



    <div class = "sidebar">
  	admin
  	<a class= "sidetext" href="admin.php?page=0">Allotted Hours</a>
  	<a class= "sidetext" href="admin.php?page=1">Current Events</a>
  	<a class= "sidetext" href="admin.php?page=2">Facilitator Edit View</a>
  	<a class= "sidetext" href="admin.php?page=3">Group Edit View</a>
  	<a class= "sidetext" href="admin.php?page=4">History</a>
  	<a class= "sidetext" href="admin.php?page=5">Holidays</a>
  	<a class= "sidetext" href="admin.php?page=6">Offsite Locations</a>
  	<a class= "sidetext" href="admin.php?page=7">Passwords</a>
  	<a class= "sidetext" href="admin.php?page=8">School Hours</a>
  	<a class= "sidetext" href="admin.php?page=9">Student Edit View</a>
  	front end
  	<a class= "sidetext" href="index.php">Front Page</a>
	<a class= "sidetext" href="statusview.php">Status View</a>
  	</div>


	<div class="ui-widget ui-helper-clearfix">

	<div id="trash" class="ui-widget-content ui-state-default">
	  <h4> group</h4>
	</div>
	<div class="droppable">
	<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">

        <?php
          for ($i=0; $i < $foo; $i++) {
              echo '<li class="ui-widget-content ui-corner-tr"><input type="hidden" value="'.$values[$i]['student_id'].'"><h5 class="ui-widget-header">'.$values[$i]['first_name'].' '.$values[$i]['last_name'][0].'.</h5></li>';

          }
         ?>

	</ul>

</div>

	</div>


  </body>
</html>
