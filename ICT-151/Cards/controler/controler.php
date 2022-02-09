<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:10
 * Updated by : Feb 2022 A.MOTTIER
 * cleanup code
 */

/**
 * This function is designed to redirect the user to the home page (depending on the action received by the index)
 */

function home(){

    require "view/home.php";
}



/**
 * This function is designed to display Snows
 * There are two different view available.
 * One for the seller, an other one for the customer.
 */
function displaySnows(){

    require_once "model/model.php";
    $snowsResults = getSnows();
    require "view/snows.php";

}

function getASnow($snow_code){

    $strgSeparator = '\'';

    $snowQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, description, photo FROM snows WHERE code='.$strgSeparator.$snow_code.$strgSeparator.'AND active=1';

    $snowResult = executeQuerySelect($snowQuery);

    return $snowResult;

}

function displayASnow(){
    require_once "model/model.php";
    $snowsResult = getASnow();
    require "view/snow_detail.php";
}

