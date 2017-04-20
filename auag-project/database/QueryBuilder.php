<?php

class MySqlQuery {

    /**
     *
     * For creating queries to access database,
     *  %u== integer
     *  %s== string
     */
    protected static $_STR_FORMAT = '%s';
    protected static $_QRY_EXPR_AND = ' AND ';
    protected static $_insertQuery = "INSERT INTO %s (%s) VALUES (%s);";
    protected static $_selectQuery = "SELECT %s FROM %s WHERE %s;";
    protected static $_updateQuery = "UPDATE %s SET %s WHERE %s;";
    protected static $_deleteQuery = "DELETE FROM %s WHERE %s;";
    protected static $_ERROR = "ERROR";

    public function insertQuery($tablename, array $columnname, array $columnsvalues) {

        $strf = self::$_STR_FORMAT;
        $col_names = "";
        $col_values = "";

        if ((count($columnname) === count($columnsvalues)) && (count($columnname) >= 1)) {

            for ($index = 0; $index < count($columnname); $index++) {
                // Prepare column names
                if ($index === 0) {
                    $col_names = sprintf($strf, $columnname[$index]);
                    $col_values = sprintf("'$strf'", $columnsvalues[$index]);
                } else {
                    $col_names = sprintf($col_names . ", " . $strf, $columnname[$index]);
                    $col_values = sprintf($col_values . ", " . "'$strf'", $columnsvalues[$index]);
                }
            }
            return sprintf(self::$_insertQuery, $tablename, $col_names, $col_values);
        } else {
            return self::$_ERROR;
        }
    }

    public function selectQuery($tablename, array $returncolums, array $selection, array $selectionArgs) {

        $condition_format = "(%s = '%s')";
        $ret_col = " %s ";

        if ((count($selectionArgs) === count($selection)) && (count($selection) >= 1) && (count($returncolums) >= 1)) {
            // Gather all the conditions and put them in expresion
            for ($index = 0; $index < count($selection); $index++) {

                if ($index === 0) {
                    $condition = sprintf($condition_format, $selection[0], $selectionArgs[0]);
                } else {
                    $condition = $condition . sprintf(self::$_QRY_EXPR_AND . $condition_format, $selection[$index], $selectionArgs[$index]);
                }
            }
            for ($i = 0; $i < count($returncolums); $i++) {
                if ($i === 0) {
                    $ret_col = sprintf($ret_col, $returncolums[0]);
                } else {
                    $ret_col = $ret_col . " ," . sprintf(self::$_STR_FORMAT, $returncolums[$i]);
                }
            }
            return sprintf(self::$_selectQuery, $ret_col, $tablename, $condition);
            
        } else if ((count($selectionArgs) === 0) && (count($selection) === 0) && (count($returncolums) >= 1)) {

            for ($i = 0; $i < count($returncolums); $i++) {
                if ($i === 0) {
                    $ret_col = sprintf($ret_col, $returncolums[0]);
                } else {
                    $ret_col = $ret_col . " ," . sprintf(self::$_STR_FORMAT, $returncolums[$i]);
                }
            }

            return sprintf(self::$_selectQuery, $ret_col, $tablename, '1');
        } else {
            return self::$_ERROR;
        }
    }

    public function updateQuery($tablename, array $columnname, array $columnsvalues, array $selection, array $selectionArgs) {
        $value_asgn_expr = "%s = '%s'";
        $condition_expr = "(%s = '%s')";
        
        $value_assignment = "";
        $condition_assignment = "";

        if ((count($columnname) === count($columnsvalues)) &&
                (count($selection) === count($selectionArgs))) {
            // Arrange colums and values
            for ($index = 0; $index < count($columnsvalues); $index++) {

                if ($index === 0) {
                    $value_assignment = sprintf($value_asgn_expr, $columnname[0], $columnsvalues[0]);
                } else {
                    $value_assignment = $value_assignment . sprintf(", " . $value_asgn_expr, $columnname[$index], $columnsvalues[$index]);
                }
            }

            for ($i = 0; $i < count($selection); $i++) {

                if ($i === 0) {
                    $condition_assignment = sprintf($condition_expr, $selection[0], $selectionArgs[0]);
                } else {
                    $condition_assignment = $condition_assignment . sprintf(self::$_QRY_EXPR_AND . $condition_expr, $selection[$i], $selectionArgs[$i]);
                }
            }
            return sprintf(self::$_updateQuery, $tablename, $value_assignment, $condition_assignment);
        } else {
            return self::$_ERROR;
        }
    }

    public function deleteQuery($tablename, array $selection, array $selectionArgs) {
        $condition_expr = "(%s = '%s')";
        $condition_assignment = "";

        if ((count($selectionArgs) === count($selection)) && (count($selection) >= 1)) {

            // Gather all the conditions and put them in expresion
            for ($index = 0; $index < count($selection); $index++) {

                if ($index === 0) {
                    $condition_assignment = sprintf($condition_expr, $selection[0], $selectionArgs[0]);
                } else {
                    $condition_assignment = $condition_assignment . sprintf(self::$_QRY_EXPR_AND . $condition_expr, $selection[$index], $selectionArgs[$index]);
                }
            }
            return sprintf(self::$_deleteQuery, $tablename, $condition_assignment);
        } else {
            return self::$_ERROR;
        }
    }

}

//$queryBuilder = new MySqlQuery();

//$query = $queryBuilder->insertQuery('members', array('phonenumber'), array('+255754710617'));
//
//$deleteQuery = $queryBuilder->deleteQuery('members', array('phonenumber', 'lastname'), array('+2557547111111', 'shirima'));
//
//$selectquery = $queryBuilder->selectQuery('inbox', array('textdecoded', 'sendernumber'), array(), array());
//
//$updatetQuery = $queryBuilder->updateQuery('members', array('shares'), array('20000'), array('memberID'), array(24));
//
//echo $query . "<br>";
//
//echo $deleteQuery . "<br>";
//
//echo $selectquery . "<br>";
//
//echo $updatetQuery . "<br>";



