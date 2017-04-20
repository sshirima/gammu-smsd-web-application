<!DOCTYPE html>
<html lang="en">

    <head >

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title >
            Save Data
        </title> 
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="lib/jquery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="lib/fontawesome/css/font-awesome.min.css">
        <script src= "view/js/members_upload.js"></script>
        <link href="view/css/tab_stlying.css" rel="stylesheet">

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
                    <li role="presentation" class="active"><a href="members.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Members"> 
                                <span class="fa fa-users"></span> 
                            </span>
                            <span class="full-nav"> Members </span></a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation"><a href="commands.php">
                            <span class="small-nav" data-toggle="tooltip" data-placement="right" title="Commands"> 
                                <span class="fa fa-tasks"></span> 
                            </span>
                            <span class="full-nav"> Commands </span></a></li>
                    <li class="nav-divider"></li>
                    <li role="presentation"><a href="report_show_user.php">
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
                            <li role="presentation" ><a href="members.php">Show</a></li>
                            <li role="presentation" class="active"><a href="members_import.php">Upload</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="panel panel-heading">
                                    <fieldset>
                                        <legend>Uploaded data</legend>
                                        <label>Members data:</label>
                                        <!-- Table -->
                                        <table class="table table-bordered table-responsive table-hover">
                                            <?php
                                            session_start();
                                            if (isset($_FILES['memberdata']['name'])) {

                                                $file_name = $_FILES['memberdata']['name'];
                                                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                                                //Checking the file extension
                                                if ($ext == "csv") {
//                                echo "Upload: " . $_FILES["memberdata"]["name"] . "<br />";
//                                echo "Type: " . $_FILES["memberdata"]["type"] . "<br />";
//                                echo "Size: " . ($_FILES["memberdata"]["size"] / 1024) . " Kb<br />";
//                                echo "Temp file: " . $_FILES["memberdata"]["tmp_name"] . "<br />";

                                                    $tmp_name = $_FILES["memberdata"]["tmp_name"];
                                                    $tableData = readCSV($tmp_name);
                                                    $_SESSION['membersData'] = $tableData;
                                                    $tr = "<tr>%s</tr>";
                                                    $td = "<td>%s</td>";
                                                    $th = "<th >%s</th>";
                                                    if (count($tableData > 0)) {
                                                        $row = "";
                                                        $tbody = "<tbody >%s</tbody>";
                                                        $thead = "<thead class=\"thead-inverse\">%s</thead>";
                                                        $theadData = "";
                                                        for ($i = 0; $i < count($tableData) - 1; $i++) {
                                                            $memberinfo = $tableData[$i];
                                                            $tdata = "";

                                                            for ($j = 0; $j < count($memberinfo); $j++) {

                                                                if ($i === 0) {
                                                                    $theadData = $theadData . sprintf($th, $memberinfo[$j]);
                                                                } else {
                                                                    $tdata = $tdata . sprintf($td, $memberinfo[$j]);
                                                                }
                                                            }
                                                            $row = $row . sprintf($tr, $tdata);
                                                        }
                                                        $rowhead = sprintf($tr, $theadData);
                                                        $theadbody = sprintf($thead, $rowhead);
                                                        $tablebody = sprintf($tbody, $row);
                                                        echo $theadbody;
                                                        echo $tablebody;
                                                    } else {
                                                        echo 'File empty';
                                                    }
                                                    //print_r($memberdata);
                                                } else {
                                                    echo '<p style="color:red;">Please upload file with csv extension only</p>';
                                                }
                                            } else {
                                                echo 'File not found';
                                            }
                                            ?>
                                        </table>
                                    </fieldset>
                                    <div class="form-group">
                                        <button id="saveMemberData" type="button" class="btn btn-primary">
                                            Save to Database
                                        </button>
                                    </div>

                                    <div class="form-group" id="saveMemberDataReponce">
                                        Result
                                    </div>
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

<?php

function readCSV($csvFile) {
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle)) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}
?>