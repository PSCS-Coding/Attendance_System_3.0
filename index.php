<?php
	require_once 'verify.php';
	require_once 'connection.php';
	require_once 'header.php';
?>

	<!DOCTYPE html>

	<html>

	<head>
		<title>
			Attendence System
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="animate.css">
		<link rel="stylesheet" type="text/css" href="js/timepicker/jquery.timepicker.min.css">
		<script src='js/timepicker/jquery.timepicker.min.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
	</head>

	<body>
		<div class='sticky-top'>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1);cursor:auto;">
				<?php require_once 'nav.html';?>
			</nav>
		</div>

		<div class="modal fade" id="offsiteModal" tabindex="-1" role="dialog" aria-labelledby="offsiteModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="offsiteModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="input-group">
							<div class="input-group-prepend location-custom">
								<a style="color:#fff" class="btn btn-danger dropdown-toggle customtog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Location
									<span class="glyphicon glyphicon-triangle-bottom">
								</a>
								<div class="dropdown-menu">
									<span class="locationdrop">
									</span>
									<div role="separator" class="dropdown-divider"></div>
									<a class="dropdown-item custom-location" onclick="toggleCustomLocation()" href="#">Custom</a>
								</div>
							</div>
							<input class="form-control" id="offsitereturn" placeholder="Return time" aria-label="Return time" aria-describedby="Return time">
							<div class="input-group-append">
								<button type='submit' class='btn btn-danger offsitesubmit'>Offsite</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="modal fade" id="fieldtripModal" tabindex="-1" role="dialog" aria-labelledby="fieldtripModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="fieldtripModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="input-group">
							<div class="input-group-prepend facilitator-custom">
								<a style='color:#fff' class="btn btn-danger dropdown-toggle fieldtog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Facilitator
									<span class="glyphicon glyphicon-triangle-bottom">
								</a>
								<div class="dropdown-menu">
									<span class="facilitatordrop">
									</span>
								</div>
							</div>
							<input class="form-control" id="fieldtripreturn" placeholder="Return time" aria-label="Return time" aria-describedby="Return time">
							<div class="input-group-append">
								<button type='submit' class='btn btn-danger fieldtripsubmit'>Field trip</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class='filter container'>
		</div>
		<div class="container students-cards">
			<div class="row">
			</div>
		</div>
		<div style='height:2em;'></div>
		<script src='js/nav.js'></script>
		<script src='js/functions.js'></script>
		<script>
			$.fn.focusWithoutScrolling = function () {
				var x = window.scrollX,
					y = window.scrollY;
				this.focus();
				window.scrollTo(x, y);
				return this;
			};
			function filter(element) {
				var value = $(element).val();
				$(".card-title").each(function () {
					if ($(this).text().toLowerCase().match('^' + value.toLowerCase())) {
						$(this).parent().parent().parent().show();
					}
					else {
						$(this).parent().parent().parent().hide();
					}
				});
			}
			$(document).ready(function () {
				$('#offsitereturn').timepicker({
					'step': 10,
					'scrollDefault': 'now',
					'minTime': '9:00am',
					'maxTime': '3:40pm'
				});
				$('#fieldtripreturn').timepicker({
					'step': 10,
					'scrollDefault': 'now',
					'minTime': '9:00am',
					'maxTime': '3:40pm'
				});
				$("body").tooltip({
					selector: '[data-toggle=tooltip]'
				});
				$('.links').html(
					'<li class="nav-item"><a href="#" class="nav-link">Groups</a></li><li class="nav-item"><a href="#" class="nav-link">Status view</a></li><li class="nav-item"><a href="view_reports.php" class="nav-link">View reports</a></li>' +
					$('.links').html()
				);
				createNav();
			});
			function build() {
				$('.filter').html('<input class="ghost-input" type="text" onkeyup="filter(this)" placeholder="Filter students" autofocus>');
				var current = query('current');
				for (var i = 0; i < current.length; i++) {
					if (query('statusIdToName', current[i]['status_id']) == 'Field Trip') {
						var info = current[i]['info'] + ' • Returning at ' + current[i]['return_time'];
						if (current[i]['return_time'].split(':')[0] >= 13) {
							var info = current[i]['info'] + ' • Returning at ' + (current[i]['return_time'].split(':')[0] - 12) + ':' +
								current[i]['return_time'].split(':')[1] + 'pm';
						} else {
							var info = current[i]['info'] + ' • Returning at ' + current[i]['return_time'].split(':')[0] + ':' + current[i][
								'return_time'
							].split(':')[1] + 'am';
						}
					} else if (query('statusIdToName', current[i]['status_id']) == 'Late') {
						if (current[i]['return_time'].split(':')[0] >= 13) {
							var info = 'Arriving at ' + (current[i]['return_time'].split(':')[0] - 12) + ':' + current[i]['return_time'].split(
								':')[1] + 'pm';
						} else {
							var info = 'Arriving at ' + current[i]['return_time'].split(':')[0] + ':' + current[i]['return_time'].split(':')[
								1] + 'am';
						}
					} else if (query('statusIdToName', current[i]['status_id']) == 'Independent Study') {
						if (current[i]['return_time'].split(':')[0] >= 13) {
							var info = 'Returning at ' + (current[i]['return_time'].split(':')[0] - 12) + ':' + current[i]['return_time'].split(
								':')[1] + 'pm';
						} else {
							var info = 'Returning at ' + current[i]['return_time'].split(':')[0] + ':' + current[i]['return_time'].split(':')[
								1] + 'am';
						}
					} else if (query('statusIdToName', current[i]['status_id']) == 'Offsite') {
						var info = current[i]['info'] + ' • Returning at ' + current[i]['return_time'];
						if (current[i]['return_time'].split(':')[0] >= 13) {
							var info = current[i]['info'] + ' • Returning at ' + (current[i]['return_time'].split(':')[0] - 12) + ':' +
								current[i]['return_time'].split(':')[1] + 'pm';
						} else {
							var info = current[i]['info'] + ' • Returning at ' + current[i]['return_time'].split(':')[0] + ':' + current[i][
								'return_time'
							].split(':')[1] + 'am';
						}
					} else if (query('statusIdToName', current[i]['status_id']) == 'Not checked in') {
						//What to put here?
						var info = 'Departed at 3:42pm yesterday';
					} else if (query('statusIdToName', current[i]['status_id']) == 'Absent') {
						//What to put here?
						var info = 'For the next two days';
					} else if (query('statusIdToName', current[i]['status_id']) == 'Checked Out') {
						//What to put here?
						var info = 'Departed at 3:27pm';
					} else {
						//What to put here?
						var info = 'Arrived at 8:48am';
					}
					var cols = 3;
					if ($(window).width() < 1200 && $(window).width() > 991) {
						cols = 4;
					} else if ($(window).width() < 992 && $(window).width() > 767) {
						cols = 6;
					} else if ($(window).width() < 768) {
						cols = 8;
					}
					//TODO: border color for not checked in after 9am and returning after return time
					var red;
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth() + 1;
					var yyyy = today.getFullYear();

					if (dd < 10) {
						dd = '0' + dd
					}

					if (mm < 10) {
						mm = '0' + mm
					}

					today = mm + '/' + dd + '/' + yyyy;
					if (moment(today + ' ' + current[i]['return_time']).isBefore(moment()) && moment(today + ' ' + current[i]['return_time']) !== moment() && current[i]['return_time'] !== '00:00:00') {
						red = 'red';
					} else {
						red = 'grey';
					}
					$('.row')
						.append(
							$('<div>')
								.attr('class', 'cols col-sm-' + cols)
								.append(
									$('<div>')
										.attr('class', 'card text-white bg-dark border-' + red)
										.append(
											$('<input>')
												.attr('type', 'checkbox')
												.attr('hidden', 'true')
										)
										.append(
											$('<div>')
												.attr('class', 'card-body')
												.append(
													$('<h5>')
														.attr('class', 'card-title')
														.text(query('studentIdToName', current[i]['student_id']).split(' ')[0] + ' ' + query('studentIdToName',
															current[i]['student_id']).split(' ')[1][0] + '.')
												)
												.append(
													$('<p>')
														.attr('class', 'card-text')
														.text(query('statusIdToName', current[i]['status_id']))
												)
										)
										.append(
											$('<div>')
												.attr('class', 'card-footer')
												.append(
													$('<small>')
														.attr('class', 'text-muted')
														.text(info)
												)
										)
								)
						)
				}
				var locations = [];
				locations = query('getLocations');
				for (var i = 0; i < locations.length; i++) {
					$('.locationdrop')
						.append(
							$('<a>')
								.attr('class', 'dropdown-item')
								.attr('onclick', 'setLocation("' + locations[i] + '")')
								.attr('href', '#')
								.text(locations[i])
						);
				}
				var facils = [];
				facils = query('getFacilitators');
				for (var i = 0; i < locations.length; i++) {
					$('.facilitatordrop')
						.append(
							$('<a>')
								.attr('class', 'dropdown-item')
								.attr('onclick', 'setFacil("' + facils[i] + '")')
								.attr('href', '#')
								.text(facils[i])
						);
				}

			}
			function wbd() {
				$.when(build()).done(function (x) {
					if ($(window).width() < 450) {
						$('.navbar-brand').html('<img src="/media/mobius.svg" style="height:2rem;cursor:pointer;">&nbsp&nbspAttendance');
					} else {
						$('.navbar-brand').html('<img src="/media/mobius.svg" style="height:2rem;cursor:pointer;">&nbsp&nbspPSCS Attendance System');
					}
					$(window).resize(function () {
						var cols = 3;
						if ($(window).width() < 1200 && $(window).width() > 991) {
							cols = 4;
						} else if ($(window).width() < 992 && $(window).width() > 767) {
							cols = 6;
						} else if ($(window).width() < 768) {
							cols = 8;
						} if ($(window).width() < 450) {
							$('.navbar-brand').html('<img src="/media/mobius.svg" style="height:2rem;cursor:pointer;">&nbsp&nbspAttendance');
						} else {
							$('.navbar-brand').html('<img src="/media/mobius.svg" style="height:2rem;cursor:pointer;">&nbsp&nbspPSCS Attendance System');
						}
						$('.cols').removeClass('col-sm-3 col-sm-4 col-sm-6 col-sm-8').addClass('col-sm-' + cols);
					});
					$(".card").click(function (e) {
						if (!e.target.className.includes('btn') && !e.target.className.includes('form')) {
							if (!$(this).find("input[type=checkbox]").is(':checked')) {

								$(this).find("input[type=checkbox]").prop('checked', true);
							} else {
								$(this).find("input[type=checkbox]").prop('checked', false);
							}
							if ($(this).hasClass('border-danger')) {
								$(this).toggleClass("toggled-red");
							} else {
								$(this).toggleClass("toggled");
							}
							var checked = 0;
							$(".students-cards :checked").each(function () {
								checked += 1;
							});
							var checked = 0;
							$(".students-cards :checked").each(function () {
								checked += 1;
							});
							if (checked > 0) {
								$('.index-actions').removeAttr('hidden');
								$('.ghost-input').val('').focusWithoutScrolling();
								filter($('.ghost-input'));
							} else {
								$('.index-actions').attr('hidden', 'true');
								if ($('.navbar-collapse').is(':visible')) {
									$('.navbar-collapse').collapse('hide');
								}
							}
							if (checked > 0) {
								if ($(window).width() < 992) {
									if ($(this).hasClass('toggled') && $('.navbar-collapse').is(':hidden')) {
										$.when($('.navbar-toggler').removeClass('animated shake')).then(function () {
											$('.navbar-toggler').addClass('animated shake');
										});
									}
								}
							}
						}
					});
				});
			}
			wbd();

			$(".offsitebutton").click(function () {
				var names = "";
				var checked = $(".students-cards :checked");
				for (var k = 0; k < checked.length; k++) {
					names += checked[k].parentNode.getElementsByClassName("card-title")[0].innerHTML.split(" ")[0];
					if (k < checked.length - 1) {
						names += ', ';
					}
				}
				$('#offsiteModalLabel').attr('data-toggle', 'tooltip');
				$('#offsiteModalLabel').attr('data-placement', 'top');
				if (checked.length > 3) {
					var mnames = checked.length + ' People';
					$('#offsiteModalLabel').text('Signing ' + mnames + ' Offsite');
					$('#offsiteModalLabel').tooltip('hide').attr('data-original-title', names).tooltip('show');
				} else {
					$('#offsiteModalLabel').text('Signing ' + names + ' Offsite');
					var porp = "";
					if (checked.length == 1) {
						porp = ' person';
					} else {
						porp = ' people';
					}
					$('#offsiteModalLabel').tooltip('hide').attr('data-original-title', checked.length + porp).tooltip('show');
				}

			});

			$(".fieldtripbutton").click(function () {
				var names = "";
				var checked = $(".students-cards :checked");
				for (var k = 0; k < checked.length; k++) {
					names += checked[k].parentNode.getElementsByClassName("card-title")[0].innerHTML.split(" ")[0];
					if (k < checked.length - 1) {
						names += ', ';
					}
				}
				$('#fieldtripModalLabel').attr('data-toggle', 'tooltip');
				$('#fieldtripModalLabel').attr('data-placement', 'top');
				if (checked.length > 3) {
					var mnames = checked.length + ' People';
					$('#fieldtripModalLabel').text('Signing ' + mnames + ' Out on a Field Trip');
					$('#fieldtripModalLabel').tooltip('hide').attr('data-original-title', names).tooltip('show');
				} else {
					$('#fieldtripModalLabel').text('Signing ' + names + ' Out on a Field Trip');
					var porp = "";
					if (checked.length == 1) {
						porp = ' person';
					} else {
						porp = ' people';
					}
					$('#fieldtripModalLabel').tooltip('hide').attr('data-original-title', checked.length + porp).tooltip('show');
				}

			});

			function toggleCustomLocation() {
				if ($('.customtog').hasClass('btn')) {
					$('.customtog').replaceWith('<input class="customtog">');
					$('.customtog').attr('type', 'text');
					$('.customtog').attr('data-toggle', 'dropdown');
					$('.customtog').attr('aria-haspopup', 'true');
					$('.customtog').attr('aria-expanded', 'true');
					$('.customtog').addClass('dropdown-toggle customtog');
					$('.customtog').attr('value', '');
					$('.customtog').attr('placeholder', 'Location');
					$('.custom-location').text('Choose from dropdown');
					$('.customtog').removeClass('btn');
					$('.customtog').removeClass('btn-danger');
				} else {
					$('.customtog').replaceWith('<a class="customtog"><span class="glyphicon glyphicon-triangle-bottom"></a>');
					$('.customtog').addClass('customtog');
					$('.custom-location').text('Custom');
					$('.customtog').text('Location');
					$('.customtog').attr('style', 'color:#fff');
					$('.customtog').attr('data-toggle', 'dropdown');
					$('.customtog').attr('aria-haspopup', 'true');
					$('.customtog').attr('aria-expanded', 'true');
					$('.customtog').addClass('btn btn-danger dropdown-toggle');
				}
			}

			function setLocation(location) {
				if ($('.customtog').is('a')) {
					$('.customtog').text(location);
				} else {
					$('.customtog').attr('value', location);
				}
			}

			function setFacil(name) {
				$('.fieldtog').text(name);
			}
			$(".fieldtripsubmit").click(function () {
				if ($('.fieldtog').text() != 'Facilitator' && $('#fieldtripreturn').val() != '') {
					var facil = $('.fieldtog').text();
					var returntime = $('#fieldtripreturn').val();
					var checked = $(".students-cards :checked");
					var current = query('current');
					var all_ids = [];
					for (var i = 0; i < current.length; i++) {
						all_ids.push(current[i]['student_id']);
					}
					//student id - doesn't work, wierd!
					var ids = [];
					for (var k = 0; k < checked.length; k++) {
						if (typeof checked[k] != 'undefined') {
							for (var i = 0; i < current.length; i++) {
								if ((query('studentIdToName', current[i]['student_id']).split(' ')[0] + ' ' + query('studentIdToName',
									current[
									i]['student_id']).split(' ')[1][0] + '.') == $(checked[k]).parent().find('.card-title').text()) {
									ids.push(all_ids[i]);
								}
							}
						}
					}
					var all = [];
					for (var i = 0; i < ids.length; i++) {
						all += ids[i] + ',';
					}
					var res = changeStatus(all, 3, facil, returntime);
					while (res != 1) {
						return 0;
					}
					$(function () {
						$('#fieldtripModal').modal('toggle');
					});
					$('.row').html('');
					$('.facilitatordrop').html('');
					$('.locationdrop').html('');
					$('.index-actions').attr('hidden', 'true');
					wbd();
				} else if ($('.fieldtog').text() == 'Facilitator' || $('#fieldtripreturn').val() == '') {
					alert('Please choose a facilitator and return time!');
				}
			});
			//TODO: make red popover for invalid submissions. Field trip & Offsite
			$(".offsitesubmit").click(function () {
				if ($('.customtog').text() != 'Location' && $('#offsitereturn').val() != '') {
					if ($('.customtog').is('a')) {
						var loc = $('.customtog').text();
					} else {
						var loc = $('.customtog').val();
					}
					var returntime = $('#offsitereturn').val();
					var checked = $(".students-cards :checked");
					var current = query('current');
					var all_ids = [];
					for (var i = 0; i < current.length; i++) {
						all_ids.push(current[i]['student_id']);
					}
					var ids = [];
					for (var k = 0; k < checked.length; k++) {
						if (typeof checked[k] != 'undefined') {
							for (var i = 0; i < current.length; i++) {
								if ((query('studentIdToName', current[i]['student_id']).split(' ')[0] + ' ' + query('studentIdToName',
									current[
									i]['student_id']).split(' ')[1][0] + '.') == $(checked[k]).parent().find('.card-title').text()) {
									ids.push(all_ids[i]);
								}
							}
						}
					}
					var all = [];
					for (var i = 0; i < ids.length; i++) {
						all += ids[i] + ',';
					}
					var res = changeStatus(all, 2, loc, returntime);
					while (res != 1) {
						return 0;
					}
					$(function () {
						$('#offsiteModal').modal('toggle');
					});
					$('.row').html('');
					$('.facilitatordrop').html('');
					$('.locationdrop').html('');
					$('.index-actions').attr('hidden', 'true');
					wbd();

				} else if ($('.customtog').text() == 'Location' || $('#offsitereturn').val() == '') {
					alert('Please choose a location & return time');
				}
			});

			$(".present").click(function () {
				var checked = $(".students-cards :checked");
				var current = query('current');
				var all_ids = [];
				for (var i = 0; i < current.length; i++) {
					all_ids.push(current[i]['student_id']);
				}
				var ids = [];
				for (var k = 0; k < checked.length; k++) {
					if (typeof checked[k] != 'undefined') {
						for (var i = 0; i < current.length; i++) {
							if ((query('studentIdToName', current[i]['student_id']).split(' ')[0] + ' ' + query('studentIdToName', current[
								i]['student_id']).split(' ')[1][0] + '.') == $(checked[k]).parent().find('.card-title').text()) {
								ids.push(all_ids[i]);
							}
						}
					}
				}
				var all = [];
				for (var i = 0; i < ids.length; i++) {
					all += ids[i] + ',';
				}
				var res = changeStatus(all, 1, '', '');
				while (res != 1) {
					return 0;
				}
				$('.row').html('');
				$('.facilitatordrop').html('');
				$('.locationdrop').html('');
				$('.index-actions').attr('hidden', 'true');
				wbd();
			});

			$(".checkout").click(function () {
				var checked = $(".students-cards :checked");
				var current = query('current');
				var all_ids = [];
				for (var i = 0; i < current.length; i++) {
					all_ids.push(current[i]['student_id']);
				}
				var ids = [];
				for (var k = 0; k < checked.length; k++) {
					if (typeof checked[k] != 'undefined') {
						for (var i = 0; i < current.length; i++) {
							if ((query('studentIdToName', current[i]['student_id']).split(' ')[0] + ' ' + query('studentIdToName', current[
								i]['student_id']).split(' ')[1][0] + '.') == $(checked[k]).parent().find('.card-title').text()) {
								ids.push(all_ids[i]);
							}
						}
					}
				}
				var all = [];
				for (var i = 0; i < ids.length; i++) {
					all += ids[i] + ',';
				}
				var res = changeStatus(all, 4, '', '');
				while (res != 1) {
					return 0;
				}
				$('.row').html('');
				$('.facilitatordrop').html('');
				$('.locationdrop').html('');
				$('.index-actions').attr('hidden', 'true');
				wbd();
			});
			$("#fieldtripModal").on("hidden.bs.modal", function () {
				setFacil('Facilitator');
				$('#fieldtripreturn').val('');
			});
			$("#offsiteModal").on("hidden.bs.modal", function () {
				setLocation('Location');
				$('#offsitereturn').val('');
			});

			function setIdle(cb, seconds) {
				var timer;
				var interval = seconds * 1000;
				function refresh() {
					clearInterval(timer);
					timer = setTimeout(cb, interval);
				};
				$(document).on('keypress, click, mousemove', refresh);
				refresh();
			}
			setIdle(function () {
				$('.row').html('');
				$('.facilitatordrop').html('');
				$('.locationdrop').html('');
				$('.index-actions').attr('hidden', 'true');
				wbd();
			}, 10);
		</script>
	</body>

	</html>