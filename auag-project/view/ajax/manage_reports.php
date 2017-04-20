<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/database/database.php';
require_once $rootDoc . '/auag-project/controller/pagecontroller/ReportShowConterller.php';

$request = filter_input(INPUT_GET, 'requestType');

$showReportController = new ReportShowController();

switch ($request) {
    case 1:
        //Pull user report
        $result = $showReportController->getUserReports();
        if (!$result == 0) {
            //
            echo json_encode($result);
        }
        break;

    case 2:
        //Pull summary report

        break;
}
