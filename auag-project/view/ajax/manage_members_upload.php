<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once $rootDoc . '/auag-project/database/database.php';
require_once $rootDoc . '/auag-project/controller/pagecontroller/UploadDataController.php';

session_start();
$tableData = $_SESSION['membersData'];

if (!empty($tableData)) {
    if (count($tableData) > 0) {
        //Check values
        $columnNames = $tableData[0];
        $resp = checkColumns($columnNames);

        if ($resp === 1) {
            // All columns are set, update the database
            $uploadMember = new UploadDataController();
            $updatedRows = 0;
            $dbresult = '';
            $successresult = '';

            for ($j = 1; $j < count($tableData)-1; $j++) {
                $member = $tableData[$j];
                $colunmname = array();
                $columnvalue = array();
                $colIndex = 0;
                $memberId = $member[array_search(DatabaseConfig::$members_phonenumber, $columnNames)];

                try {
                    //Format date (s), NOR date
                    $NOR_date = $member[array_search(DatabaseConfig::$members_NOR_date, $columnNames)];
                    if ($NOR_date == "" || $NOR_date == " "){
                        throw new Exception(DatabaseConfig::$members_NOR_date.': Field empty');
                    }
                    
                    $NOR_date_formated = new DateTime($NOR_date);
                    $member[array_search(DatabaseConfig::$members_NOR_date, $columnNames)] = $NOR_date_formated->format("Y-m-d");

                    //Format date (s), end loan date
                    $END_date = $member[array_search(DatabaseConfig::$members_end_loan_date, $columnNames)];
                    if ($END_date == "" || $END_date == " "){
                        throw new Exception(DatabaseConfig::$members_end_loan_date.': Field empty');
                    }
                    
                    $END_date_formated = new DateTime($END_date);
                    $member[array_search(DatabaseConfig::$members_end_loan_date, $columnNames)] = $END_date_formated->format("Y-m-d");


                    if (isset($memberId)) {
                        //Check if the member exist
                        $checkMember = $uploadMember->selectMember($memberId);
                    } else {
                        throw new Exception('Member Id not Set, or empty column');
                    }

                    if ($checkMember == 0) {
                        // Member not found, therefore add new member
                        $result = $uploadMember->insertMember(getColumnNameArray($columnNames), getColumnValuesArray($columnNames, $member));
                    } else {
                        //Member found, therefore update member info
                        $result = $uploadMember->updateMemberData($memberId, getColumnNameArray($columnNames), getColumnValuesArray($columnNames, $member));
                    }
                } catch (Exception $ex) {
                    $result = "Exception: " . $ex->getMessage();
                }

                if (!($result == 1)) {
                    $dbresult = $dbresult . '<br><br><b>Row ' . $j . "</b>==>" . $result;
                } else {
                    $updatedRows++;
                }
            }

            if (empty($dbresult)) {
                echo '<div class="alert alert-success" role="alert">Database updated <b>successful!</b></div>';
            } else {
                echo '<div class="alert alert-warning" role="alert"> Number of updated rows:<b>' . $updatedRows . '</b>'
                . $dbresult . '</div>';
            }
        } else {
            echo $resp;
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">No data present</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">File not found</div>';
}

function getColumnNameArray(array $columnNames) {
    return array($columnNames[array_search(DatabaseConfig::$members_firstname, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_phonenumber, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_shares, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_pending_jamii, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_pending_fines, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_NOR_date, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_NR_amount, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_TP_Marejesho, $columnNames)],
        $columnNames[array_search(DatabaseConfig::$members_end_loan_date, $columnNames)]);
}

function getColumnValuesArray(array $columnNames, array $colunmValues) {
    return array($colunmValues[array_search(DatabaseConfig::$members_firstname, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_phonenumber, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_shares, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_pending_jamii, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_pending_fines, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_NOR_date, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_NR_amount, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_TP_Marejesho, $columnNames)],
        $colunmValues[array_search(DatabaseConfig::$members_end_loan_date, $columnNames)]);
}

function checkColumns($columnsNames) {
    $responce = "";

    if (!in_array(DatabaseConfig::$members_firstname, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_firstname . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_LP_progress, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_LP_progress . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_NOR_date, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_NOR_date . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_NR_amount, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_NR_amount . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_TP_Marejesho, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_TP_Marejesho . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_end_loan_date, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_end_loan_date . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_pending_fines, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_pending_fines . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_pending_jamii, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_pending_jamii . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_phonenumber, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_phonenumber . " column missing<br>";
    }
    if (!in_array(DatabaseConfig::$members_shares, $columnsNames)) {
        $responce = $responce . DatabaseConfig::$members_shares . " column missing<br>";
    }
    if (empty($responce)) {
        return 1;
    } else {
        return $responce;
    }
}

function readCSV($csvFile) {
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle)) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}
