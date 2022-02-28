<?php
function getSnows(){
    $snowsQuery = 'SELECT code, brand, model, snowLength, dailyPrice, 
qtyAvailable, photo, active FROM snows';
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
    $strgSeparator = '\'';

    $snowQuery = 'SELECT code, brand, model, snowLength, dailyPrice, 
qtyAvailable, description, photo FROM snows WHERE 
code='.$strgSeparator.$snow_code.$strgSeparator.'AND active=1';
    require_once 'model/dbConnector.php';
    $snowResults = executeQuerySelect($snowQuery);
    return $snowResults;
}