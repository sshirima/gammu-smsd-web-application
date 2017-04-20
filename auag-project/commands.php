<!DOCTYPE html>
<html lang="en">

    <head >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title >
            SMS commands
        </title> 
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.min.css">
        <script src="js/homepage.js"></script>
        <link rel="stylesheet" type="text/css" href="lib/shieldUI/all.min.css" />
        <script type="text/javascript" src="lib/shieldUI/shieldui-lite-all.min.js"></script>
        <script type="text/javascript" src="lib/shieldUI/shortGridData.js"></script>
        <script src="view/js/commands.js"></script>
        <link href="view/css/tab_stlying.css" rel="stylesheet">
    </head>

    <body >

        <div class="row" style="height: 100px">

        </div>
        
        <div class="row" style="padding: 20px">

            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked" >
                    <li class="nav-divider"></li>
                    <li role="presentation" ><a href="index.php">
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
                    <li role="presentation"class="active"><a href="commands.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Commands"> 
                                <span class="fa fa-envelope-o"></span> 
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

            <div class="col-md-10" >
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="commands.php">View SMS commands</a></li>
                            <li role="presentation" ><a href="commands_actions.php">Command actions</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            <legend>Manage SMS commands</legend>
                            <div id="container">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="text-left">Available commands</h4>
                                        </div>
                                        <div class="panel-body text-left">
                                            <div id="grid"></div>
                                            <div id="actions" hidden></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </fieldset> 
                    </div>
                </div>

            </div>

        </div>
        <div class="navbar navbar-default navbar-fixed-bottom ">
            <div class="container">
                <p class="navbar-text">© 2017 - shirimas@gmail.com </p>
            </div>
        </div>

    </body>

</html>
