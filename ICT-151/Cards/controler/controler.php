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
    $_GET['action'] = "home";
    require "view/home.php";
}



/**
 * This function is designed to display Snows
 * There are two different view available.
 * One for the seller, an other one for the customer.
 */
function displaySnows(){
    require_once "model/snowsManager.php";
    $snowsResults = getSnows();
    $usertype=$_SESSION['userType'];
    if($usertype==1){
        require "view/snows_admin.php";
    }
    else{
        require "view/snows.php";
    }
}



/**
 * This function is designed to get only one snow results (for aSnow view)
 * @param none
 */
function displayASnow($snow_code){
    require_once "../model/snowsManager.php";
    $snowsResults= getASnow($snow_code);
    require "../view/snow_detail.php";
}

function login($loginRequest){
    //if a login request was submitted
    if (isset($loginRequest['inputUserEmailAddress']) &&
        isset($loginRequest['inputUserPsw'])) {
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
    }else{ //the user hasn’t yet filled the form
        $_GET['action'] = "login";
        require "view/login.php";
    }
}
function logout(){
    session_start();
    session_destroy();
    header("Location:index.php");
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
