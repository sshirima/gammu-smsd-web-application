<?php
$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/controller/pagecontroller/HomePageController.php';

function showModemsDetails() {

    $homePageController = new HomePageController();

    $phones = $homePageController->getPhoneDetails();

    return $phones;
}

function showGammuSmsDStatus() {

    $homePageController = new HomePageController();

    $phones = $homePageController->getGammuSmsdStatus();

    return $phones;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title >
            AUAG
        </title> 
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.min.css">
        <script src="view/js/index.js"></script>
        <link href="view/css/tab_stlying.css" rel="stylesheet">
    </head>

    <body >

        <div class="row" style="height: 100px">

        </div>

        <div class="row" style="padding: 20px">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-divider"></li>
                    <li role="presentation" class="active"><a href="index.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Dashboard"> 
                                <span class="fa fa-tachometer"></span> 
                            </span>
                            <span class="full-nav"> Dashboard </span></a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation" ><a href="members.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Members"> 
                                <span class="fa fa-address-card"></span> 
                            </span>
                            <span class="full-nav"> Members </span></a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation"><a href="commands.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Commands"> 
                                <span class="fa  fa-envelope-o"></span> 
                            </span>
                            <span class="full-nav"> Commands </span></a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation"><a href="reports.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Reports"> 
                                <span class="fa fa-tasks"></span> 
                            </span>
                            <span class="full-nav"> Reports </span></a></li>
                    <li class="nav-divider"></li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="index.php">Monitoring</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            <legend>Modem information</legend>
                            <label>Modem status:</label>
                            <div id="modemStatus"><?php echo showModemsDetails(); ?></div>
                        </fieldset>

                        <fieldset>
                            <legend>Gammu</legend>
                            <label>Sms Deamon status:</label>
                            <div id="smsdStatus"><?php echo showGammuSmsDStatus(); ?></div>
                        </fieldset>

                        <fieldset>
                            <legend>Server</legend>
                            <label>Server information:</label>
                            <div class="row" >
                                <div class="col-md-2" id="serverStatusIcon" style="padding: 10px">
                                    <i class="fa fa-cog fa-2x fa-fw"></i>
                                    <span class="sr-only">Running</span>
                                </div> 
                                <div class="col-md-10">

                                    <div class="col-sm-4" >
                                        <label for="serverStatus" class="control-label">Status: </label>
                                        <div id="serverStatus">
                                            Stopped
                                        </div>
                                    </div>

                                    <div class="col-sm-4" id="smsprocessstatus">
                                        <label for="msgprocessStatus"  class="control-label"> Processing status</label>
                                        <div id="msgprocessStatus">
                                            Stopped
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="labeltimer"  class="control-label">Server Uptime:</label>
                                        <div  id="labeltimer">
                                            0
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div style="padding-top: 10px">
                                <button id="runServer" type="button" class="btn btn-primary">
                                    Start server
                                </button>
                            </div>

                        </fieldset>
                    </div>

                </div>

            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="navbar navbar-default navbar-fixed-bottom ">
            <div class="container">
                <p class="navbar-text"><i class="fa fa-copyright" aria-hidden="true"></i> 2017 - shirimas@gmail.com </p>
            </div>
        </div>
    </body>

</html>


