<?php
/**
 * This php file is designed to manage all operation regarding snow's management
 * Author   : pascal.benzonana@cpnv.ch
 * Updated by : 2022 - André MOTTIER
 *              Add CRUD for snows table
 */

/**
 * This function is designed to get all active snows
 * @return array : containing all information about snows. Array can be empty.
 */
function getSnows(){
    $snowsQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, photo, active FROM snows';

    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowsQuery);

    return $snowResults;
}

/**
 * This function is designed to get only one snow
 * @param $snow_code : snow code to display (selected by the user)
 * @return array|null : snow to display. Can be empty.
 */
function getASnow($snow_code){
    $strSeparator = '\'';

    // Query to get the selected snow. The active code must be set to 1 to display only snows to display. It avoids possibilty to user selecting a wrong code (get paramater in url)
    $snowQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, description, photo, active FROM snows WHERE code=' . $strSeparator . $snow_code . $strSeparator ;

    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowQuery);

    return $snowResults;
}

/**
 * This function is designed to register a new account
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool|null
 */
function addNewSnow($code, $brand, $model, $snowLength, $qtyAvailable, $description, $dailyPrice, $photo ){
    $result = false;

    $strSeparator = '\'';

    // test de requete manuel pour debug
    // $addSnowQuery = "INSERT INTO snows (`code`, `brand`,`model`, `snowLength`,`qtyAvailable`, `description`,`dailyPrice`, `photo`,`active`) VALUES ('a','a','a','1','1','a','1','a','1')";

    $addSnowQuery = 'INSERT INTO snows (`code`, `brand`,`model`, `snowLength`,`qtyAvailable`, `description`,`dailyPrice`, `photo`,`active`) VALUES (' .$strSeparator . $code .$strSeparator . ',' . $strSeparator . $brand . $strSeparator. ',' .$strSeparator . $model . $strSeparator . ',' . $strSeparator . $snowLength . $strSeparator . ',' . $strSeparator . $qtyAvailable . $strSeparator. ',' . $strSeparator . $description .$strSeparator . ','. $strSeparator . $dailyPrice . $strSeparator . ',' . $strSeparator . $photo . $strSeparator . ',' . $strSeparator . '1' . $strSeparator . ')';

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addSnowQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function deleteASnow($code)
{
    $result = false;
    $strSeparator = '\'';
    $addSnowQuery = 'DELETE FROM snows WHERE (`code`) LIKE (' .$strSeparator . $code .$strSeparator .')';
    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addSnowQuery);
    $queryResult = executeQuery($addSnowQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function updateASnow($code, $brand, $model, $snowLength, $qtyAvailable, $description, $dailyPrice, $photo,$active ){
    $result = false;

    $strSeparator = '\'';

    // test de requete manuel pour debug
    // $addSnowQuery = "INSERT INTO snows (`code`, `brand`,`model`, `snowLength`,`qtyAvailable`, `description`,`dailyPrice`, `photo`,`active`) VALUES ('a','a','a','1','1','a','1','a','1')";

    $updateSnowQuery = 'UPDATE snows SET code= ' . $strSeparator . $code.$strSeparator
        . ', brand=' . $strSeparator . $brand . $strSeparator
        . ', model=' . $strSeparator. $model .$strSeparator
        . ', snowLength=' . $strSeparator. $snowLength .$strSeparator
        . ', qtyAvailable=' . $strSeparator. $qtyAvailable .$strSeparator
        . ', description=' . $strSeparator. $description .$strSeparator
        . ', dailyPrice=' . $strSeparator. $dailyPrice .$strSeparator
        . ', photo=' . $strSeparator. $photo .$strSeparator
        . ', active=' . $strSeparator. $active .$strSeparator
        .' WHERE code LIKE '.$strSeparator.$code.$strSeparator;



    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addSnowQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}
