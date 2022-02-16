<?php
/**
 * This function is designed to verify user's login
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool : "true" only if the user and psw match the database. In all
other cases will be "false".
 */
function isLoginCorrect($userEmailAddress, $userPsw){
    $result = false;
    $strSeparator = '\'';
    $loginQuery = 'SELECT userHashPsw FROM users WHERE userEmailAddress = '.
        $strSeparator . $userEmailAddress . $strSeparator;
    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($loginQuery);
    if (count($queryResult) == 1)
    {
        $userHashPsw = $queryResult[0]['userHashPsw'];
        $hashPasswordDebug = password_hash($userPsw, PASSWORD_DEFAULT);
        $result = password_verify($userPsw, $userHashPsw);
    }
    return $result;
}
/**
 * This function is designed to get the type of user
 * For the webapp, it will adapt the behavior of the GUI
 * @param $userEmailAddress
 * @return int (0 = customer ; 1 = seller)
 */
function getUserType($userEmailAddress){
    $result = 0;//we fix the result to 0 -> customer
    $strSeparator = '\'';
    $getUserTypeQuery = 'SELECT userType FROM users WHERE users.userEmailAddress 
=' . $strSeparator . $userEmailAddress . $strSeparator;
    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($getUserTypeQuery);
    if (count($queryResult) == 1){
        $result = $queryResult[0]['userType'];
    }
    return $result;
}
