
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
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.min.css">
        <script src="js/homepage.js"></script>
        <style >

        </style>
    </head>

    <body >

        <div class="row" style="width: 1000px; height: 100px">

        </div>

        <div class="row" style="padding: 20px">
            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                </ul>
            </div>
            <div class="col-md-10" style="padding: 20px">
                <fieldset>
                    <legend>Modem</legend>
                    <label>Modem status:</label>
                    <div class="alert alert-success" role="alert"> Success</div>
                </fieldset>

                <fieldset>
                    <legend>Server</legend>
                    <label>Server status:</label>
                    <div class="row" >
                        <div class="col-md-4" id="serverStatusIcon" style="padding: 10px">
                            <i class="fa fa-cog fa-2x fa-fw"></i>
                            <span class="sr-only">Running</span>
                        </div> 
                        <div class="col-md-6">
                            <label for="serverStatus" class="col-sm-2 control-label">Status:</label>
                            <div class="col-sm-4" id="serverStatus">
                                Running
                            </div>
                            
                            <label for="labeltimer" class="col-sm-2 control-label">Uptime:</label>
                            <div class="col-sm-4" id="labeltimer">
                                0
                            </div>
                        </div> 
                    </div>
                    <div style="padding-top: 10px">
                        <button type="button" onclick="upTime(0)" nclass="btn btn-primary">
                            Start server
                        </button>
                    </div>

                </fieldset>
            </div>
            <div class="col-md-4"></div>
        </div>
    </body>

</html>
<?php

