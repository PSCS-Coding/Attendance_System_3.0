<?php
  require_once('verify.php');
  require_once('connection.php');
  require_once('header.php');
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Attendance System: Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div class='sticky-top'>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1);">
                <?php require_once('nav.html');?>
            </nav>
        </div>
        <div class='container prof-content text-white row'>
            <div class='col-sm-3'>
                <img class='bigpic' src="/media/loading_spinner.gif" data-toggle="tooltip" data-placement="bottom" title="Profile picture">
                <h3 class='bigname'></h3>
                <h4 class='muted grade-admin'></h4>
                <hr/>
                <p class='muted coins'></p>
                <hr/>
                <p class='muted'>
                    <i style='color: #9b9fa2;' class="fas fa-envelope"></i>&nbsp;
                    <a class='muted hover-normal email'></a>
                </p>
            </div>
            <div class='col-sm-9'>
                <div class='container prof-options'>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-coin-tab" data-toggle="tab" href="#nav-coin" role="tab" aria-controls="nav-coin"
                                aria-selected="true">Integrity coin</a>
                            <a class="nav-item nav-link" id="nav-achievements-tab" data-toggle="tab" href="#nav-achievements" role="tab" aria-controls="nav-achievements"
                                aria-selected="false">Achievements</a>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-coin" role="tabpanel" aria-labelledby="nav-coin-tab">To be built: Integrity coin purchasing system</div>
                        <div class="tab-pane fade" id="nav-achievements" role="tabpanel" aria-labelledby="nav-achievements-tab">To be built: Achievments chart</div>
                    </div>
                    </div>
                </div>

                <script src='js/nav.js'></script>
                <script src='js/functions.js'></script>
                <script type='text/javascript'>
                    function edit(element) {
                        var attribute_text = '';
                        var val = $(element).text();
                        $.each($(element).get(0).attributes, function (i, attrib) {
                            attribute_text = attribute_text + (attrib.name + '="' + attrib.value + '" ');
                        });

                        $(element).replaceWith('<input value="' + val + '" type="text" ' + attribute_text + 'id="1">');
                        document.getElementById('1').select();
                        $(document.getElementById('1')).addClass('in-edit');
                        $('.in-edit').focusout(function () {
                            var eltype = $('.in-edit').attr('oldel');
                            var val = $('.in-edit').val();
                            var attribute_text = '';
                            $.each($('.in-edit').get(0).attributes, function (i, attrib) {
                                attribute_text = attribute_text + (attrib.name + '="' + attrib.value + '" ');
                            });
                            alert('Warning: This doesn\'t actually query the database yet!');
                            $('.in-edit').replaceWith('<' + eltype + ' ' + attribute_text + '>' + val + '</' + eltype + '>');
                            $(document.getElementById('1')).removeClass('in-edit');
                            $(document.getElementById('1')).removeAttr('id');
                            $(".editable").click(function () {
                                edit(this);
                            });
                        });
                    }
                    $(document).ready(function () {
                        $(function () {
                            $('[data-toggle="popover"]').popover();
                        });
                        createNav();
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                        userdata = getUserData().split("~!@#$%^&");
                        $('.index-actions').html('');
                        $('.navusercoin').attr('href', 'index.php');
                        $('.navusercoin').text('Main page');
                        if (userdata[4] == 'admin') {
                            if (getCookie('tour') !== 1) {
                                //TODO put bootstrap tour here that says 'There's not much here for admin users, but you can edit your info here.'
                            }
                            $('.prof-content').html("<div class='container admin-prof-info'><img class='bigpic' src='/media/loading_spinner.gif' data-toggle='tooltip' data-placement='bottom' title='Profile picture'><br><h2 oldel='h2' class='bigname text-center editable'></h2><h3 oldel='h3' class='muted text-center editable'>Admin user</div>");
                        } else {
                            $('.grade-admin').html(((userdata[6] - new Date().getFullYear()) + 6) + 'th grade');
                        }
                        $('.bigpic').attr('src', userdata[3]);
                        $('.bigname').text(userdata[0] + ' ' + userdata[1]);
                        $('.email').text(userdata[2]);
                        $('.email').attr('href', 'mailto:' + userdata[2]);
                        $('.coins').html('Your current <a tabindex="0" data-trigger="focus" class="pointer" data-toggle="popover" data-placement="right" data-content="Integrity coins are a currency you can get by having a good offsite record. They are used to customize your profile and the display of the attendance system. They may be disabled in settings.">integrity coin</a> balance is \u00A2' + userdata[5] + '.');
                        $(".editable").click(function () {
                            edit(this);
                        });
                    });
                </script>
    </body>

    </html>