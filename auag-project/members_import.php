<!DOCTYPE html>
<html lang="en">
    <head >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title >
            Upload data
        </title> 
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="lib/kartik-fileuploader/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/kartik-fileuploader/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
        <script src="lib/kartik-fileuploader/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="lib/kartik-fileuploader/js/plugins/purify.min.js" type="text/javascript"></script>
        <!-- the main fileinput plugin file -->
        <script src="lib/kartik-fileuploader/js/fileinput.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.min.css">
        <script src="lib/kartik-fileuploader/themes/fa/theme.js"></script>
        <link href="view/css/tab_stlying.css" rel="stylesheet">
        <!-- File uploader library -->

    </head>

    <body >

        <div class="row" style="height: 100px">

        </div>

        <div class="row" style="padding: 20px">

            <div class="col-md-2">
                <ul class="nav nav-pills nav-stacked">
                    <li class="nav-divider"></li>
                    <li role="presentation" ><a href="index.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Dashboard"> 
                                <span class="fa fa-tachometer"></span> 
                            </span>
                            <span class="full-nav"> Dashboard </span></a></li>
                    </a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation" class="active" ><a href="members.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Members"> 
                                <span class="fa fa-address-card"></span> 
                            </span>
                            <span class="full-nav"> Members </span></a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation"><a href="commands.php">
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

            <div class="col-md-10">
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li role="presentation" ><a href="members.php">View member</a></li>
                            <li role="presentation" class="active"><a href="members_import.php">Import member info</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <fieldset>
                                        <form enctype="multipart/form-data" action="members_upload.php" method="post" class="form-horizontal">
                                            <legend>Upload member information</legend>
                                            <label >Select File</label>
                                            <input name="memberdata" id="memberdata" type="file" class="file"/>
                                        </form>
                                    </fieldset> 
                                </div>
                            </div>
                        </div>
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

