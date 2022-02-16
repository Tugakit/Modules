<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:10
 * Updated by : 12-MAR-2019 - nicolas.glassey
 *              Add register function
 */

/**
 * This function is designed to redirect the user to the home page (depending on the action received by the index)
 */

function home(){
    $_GET['action'] = "home";
    require "view/home.php";
}

//region snows management
/**
 * This function is designed to display Snows
 * There are two different view available.
 * One for the seller, an other one for the customer.
 */
function displaySnows(){
    if (isset($_POST['resetCart'])) {
        unset($_SESSION['cart']);
    }

    require_once "model/snowsManager.php";
    $snowsResults = getSnows();

    $_GET['action'] = "displaySnows";
    if (isset($_SESSION['userType']))
    {
        switch ($_SESSION['userType']) {
            case 0://this is a customer
                require "view/snows.php";
                break;
            case 1://this a seller
                require "view/snowsSeller.php";
                break;
            default:
                require "view/snows.php";
                break;
        }
    }else{
        require "view/snows.php";
    }
}

/**
 * This function is designed to get only one snow results (for aSnow view)
 * @param none
 */
function displayASnow($snow_code){
    if (isset($registerRequest['inputUserEmailAddress'])){
        //TODO
    }
    require_once "model/snowsManager.php";
    $snowsResults= getASnow($snow_code);
    require "view/aSnow.php";
}
//endregion
