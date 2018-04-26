<?php
require_once 'verify.php';
require_once 'connection.php';
require_once 'header.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Attendance System: Settings</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body class='noselect'>
        <div class='sticky-top'>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar" style="box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1);">
                <?php require_once 'nav.html';?>

            </nav>
        </div>

        <div class='container settings-content text-white row'>
            <div class='col-sm-3 settings-nav'>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-options-tab" data-toggle="pill" href="#v-pills-options" role="tab" aria-controls="v-pills-options"
                        aria-selected="true">Options</a>
                    <a class="nav-link" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account"
                        aria-selected="false">Account</a>
                    <a class="nav-link" id="v-pills-email-tab" data-toggle="pill" href="#v-pills-email" role="tab" aria-controls="v-pills-email"
                        aria-selected="false">Emails</a>
                </div>
            </div>
            <div class='col-sm-9'>
                <div class='container settings-options'>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-options" role="tabpanel" aria-labelledby="v-pills-options-tab">
                            <h2 class="display-4 options">General options</h2>
                            <hr />
                            <div class='coin-settings'>
                                <h4 class='container-fluid noselect pointer'>
                                    <label for='integrity-checkbox' class='pointer'>
                                        Integrity coins
                                    </label>
                                    <label for='integrity-checkbox' class="switch align-middle float-right">
                                        <input type="checkbox" id='integrity-checkbox'>
                                        <span class="slider round"></span>
                                    </label>
                                </h4>
                                <div class="collapse" id="integrity-options">
                                    <div class='tabbed'>
                                        <label for='streak-checkbox' class='pointer'>
                                            <p>Show your streak on the public leaderboards</p>
                                        </label>
                                        <label for='streak-checkbox' class="small-switch align-middle float-right">
                                            <input type="checkbox" id='streak-checkbox'>
                                            <span class="small-slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class='test-settings'>
                                <h4 class='container-fluid noselect pointer'>
                                    <label for='test-checkbox' class='pointer'>
                                        This is a test setting
                                    </label>
                                    <label for='test-checkbox' class="switch align-middle float-right">
                                        <input type="checkbox" id='test-checkbox'>
                                        <span class="slider round"></span>
                                    </label>
                                </h4>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                            <h2 class="display-4 options">Account options</h2>
                            <hr />
                        </div>

                        <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                            <h2 class="display-4 options">Email options</h2>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src='/js/nav.js'></script>
        <script type='text/javascript'>
            $(document).ready(function () {
                createNav();
                $('.index-actions').html('');
                $('.navuserhome').attr('href', 'index.php');
                $('.navuserhome').text('Main page');
            });
            function collapse_status(collapse) {
                var status = '';
                if($(collapse).hasClass('collapse') && !$(collapse).hasClass('show')) {
                    status = 'hidden';
                }
                if($(collapse).hasClass('collapsing')) {
                    status = 'in progress';
                }
                if($(collapse).hasClass('collapse') && $(collapse).hasClass('show')) {
                    status = 'visible';
                }
                return status;
            }
            $("#integrity-checkbox").change(function () {
                var status = collapse_status("#integrity-options");
                if (status !== 'in progress') {
                    if (this.checked) {
                        $('#integrity-options').collapse('show');
                        //update db/cookies
                    } else {
                        $('#integrity-options').collapse('hide');
                        //update db/cookies
                    }
                } else {
                    $("#integrity-checkbox").prop('checked', !$(this).prop('checked'));
                }
            });
        </script>
    </body>

    </html>