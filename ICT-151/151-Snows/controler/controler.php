<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Updated by : 2022 - André MOTTIER
 *              Add CRUD for snows table
 */

/**
 * This function is designed to redirect the user to the home page (depending on the action received by the index)
 */

function home(){
    $_GET['action'] = "home";
    require "view/home.php";
}

//region users management
/**
 * This function is designed to manage login request
 * @param $loginRequest containing login fields required to authenticate the user
 */
function login($loginRequest){
    //if a login request was submitted
    if (isset($loginRequest['inputUserEmailAddress']) && isset($loginRequest['inputUserPsw'])) {
        //extract login parameters
        $userEmailAddress = $loginRequest['inputUserEmailAddress'];
        $userPsw = $loginRequest['inputUserPsw'];

        //try to check if user/psw are matching with the database
        require_once "model/usersManager.php";
        if (isLoginCorrect($userEmailAddress, $userPsw)) {
            createSession($userEmailAddress);
            $_GET['loginError'] = false;
            $_GET['action'] = "home";
            require "view/home.php";
        } else { //if the user/psw does not match, login form appears again
            $_GET['loginError'] = true;
            $_GET['action'] = "login";
            require "view/login.php";
        }
    }else{ //the user does not yet fill the form
        $_GET['action'] = "login";
        require "view/login.php";
    }
}

/**
 * This fonction is designed
 * @param $registerRequest
 */
function register($registerRequest){
    //variable set
    if (isset($registerRequest['inputUserEmailAddress']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserPswRepeat'])) {

        //extract register parameters
        $userEmailAddress = $registerRequest['inputUserEmailAddress'];
        $userPsw = $registerRequest['inputUserPsw'];
        $userPswRepeat = $registerRequest['inputUserPswRepeat'];

        if ($userPsw == $userPswRepeat){
            require_once "model/usersManager.php";
            if (registerNewAccount($userEmailAddress, $userPsw)){
                createSession($userEmailAddress);
                $_GET['registerError'] = false;
                $_GET['action'] = "home";
                require "view/home.php";
            }
        }else{
            $_GET['registerError'] = true;
            $_GET['action'] = "register";
            require "view/register.php";
        }
    }else{
        $_GET['action'] = "register";
        require "view/register.php";
    }
}

/**
 * This function is designed to create a new user session
 * @param $userEmailAddress : user unique id
 */
function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    //set user type in Session
    $userType = getUserType($userEmailAddress);
    $_SESSION['userType'] = $userType;
}

/**
 * This function is designed to manage logout request
 */
function logout(){
    $_SESSION = array();
    session_destroy();
    $_GET['action'] = "home";
    require "view/home.php";
}
//endregion


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


function addSnow($addSnowRequest){

    if (isset($addSnowRequest['inputCode']) && isset($addSnowRequest['inputBrand']) && isset($addSnowRequest['inputModel'])&& isset($addSnowRequest['inputSnowLength'])&& isset($addSnowRequest['inputQtyAvailable'])&& isset($addSnowRequest['inputDescription'])&& isset($addSnowRequest['inputDailyPrice'])&& isset($addSnowRequest['inputPhoto'])) {

        //extract parameters
        $code = $addSnowRequest['inputCode'];
        $brand = $addSnowRequest['inputBrand'];
        $model = $addSnowRequest['inputModel'];
        $snowLength = $addSnowRequest['inputSnowLength'];
        $qtyAvailable = $addSnowRequest['inputQtyAvailable'];
        $description = $addSnowRequest['inputDescription'];
        $dailyPrice = $addSnowRequest['inputDailyPrice'];
        $photo = $addSnowRequest['inputPhoto'];
        $active = $addSnowRequest['inputActive'];

        require_once "model/snowsManager.php";
            if (addNewSnow($code, $brand, $model, $snowLength, $qtyAvailable, $description, $dailyPrice, $photo, $active)){
                $_GET['action'] = "addSuccess";
                $snowsResults = getSnows();
                require "view/snowsSeller.php";
            }else{
                $_GET['addSnowError'] = true;
                require "view/addSnow.php";
        }
    }else{
        require "view/addSnow.php";
    }
}

function deleteSnow($snow_code){
    require_once "model/snowsManager.php";
    if (deleteASnow($snow_code)){
        $_GET['action'] = "deleteSuccess";
        $snowsResults = getSnows();
        require "view/snowsSeller.php";
    }else{
        $_GET['addSnowError'] = true;
        require "view/snowsSeller.php";
    }
}

function editSnow($snow_code){
    require_once "model/snowsManager.php";
    $snowsResults= getASnow($snow_code);
    require "view/editSnow.php";

}
function updateSnow($addSnowRequest) {
    if (isset($addSnowRequest['inputCode']) && isset($addSnowRequest['inputBrand']) && isset($addSnowRequest['inputModel'])&& isset($addSnowRequest['inputSnowLength'])&& isset($addSnowRequest['inputQtyAvailable'])&& isset($addSnowRequest['inputDescription'])&& isset($addSnowRequest['inputDailyPrice'])&& isset($addSnowRequest['inputPhoto'])) {

        //extract parameters
        $code = $addSnowRequest['inputCode'];
        $brand = $addSnowRequest['inputBrand'];
        $model = $addSnowRequest['inputModel'];
        $snowLength = $addSnowRequest['inputSnowLength'];
        $qtyAvailable = $addSnowRequest['inputQtyAvailable'];
        $description = $addSnowRequest['inputDescription'];
        $dailyPrice = $addSnowRequest['inputDailyPrice'];
        $photo = $addSnowRequest['inputPhoto'];
        $active = $addSnowRequest['inputActive'];

        require_once "model/snowsManager.php";
        if (updateASnow($code, $brand, $model, $snowLength, $qtyAvailable, $description, $dailyPrice, $photo, $active)){
            $_GET['action'] = "addSuccess";
            $snowsResults = getSnows();
            require "view/snowsSeller.php";
        }else{
            $_GET['addSnowError'] = true;
            require "view/addSnow.php";
        }
    }else{
        require "view/addSnow.php";
    }
}