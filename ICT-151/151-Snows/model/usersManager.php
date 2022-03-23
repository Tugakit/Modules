<?php
/**
 * This php file is designed to manage all operations regarding user's management
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : Code
 * Created  : 31.01.2019 - 18:40
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Source       :   pascal.benzonana
 */

/**
 * This function is designed to verify user's login
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool : "true" only if the user and psw match the database. In all other cases will be "false".
 */
function isLoginCorrect($userEmailAddress, $userPsw){
    $result = false;

    $strSeparator = '\'';
    $loginQuery = 'SELECT userHashPsw FROM users WHERE userEmailAddress = '. $strSeparator . $userEmailAddress . $strSeparator;

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

function getUsers(): ?array
{
    $usersQuery = 'SELECT id, userEmailAddress,userHashPsw, userType FROM users';

    require_once 'model/dbConnector.php';
    $usersResults = executeQuerySelect($usersQuery);

    return $usersResults;
}

function getAUser($User_id){
    $strSeparator = '\'';

    // Query to get the selected snow. The active code must be set to 1 to display only snows to display. It avoids possibilty to user selecting a wrong code (get paramater in url)
    $snowQuery = 'SELECT * FROM users WHERE id LIKE ' . $strSeparator . $User_id . $strSeparator ;

    require_once 'model/dbConnector.php';
    $usersResults = executeQuerySelect($snowQuery);

    return $usersResults;
}

/**
 * This function is designed to register a new account
 * @param $userEmailAddress
 * @param $userPsw
 * @return bool|null
 */
function registerNewAccount($userEmailAddress, $userPsw){
    $result = false;

    $strSeparator = '\'';

    $userHashPsw = password_hash($userPsw, PASSWORD_DEFAULT);

    $registerQuery = 'INSERT INTO users (`userEmailAddress`, `userHashPsw`) VALUES (' .$strSeparator . $userEmailAddress .$strSeparator . ','.$strSeparator . $userHashPsw .$strSeparator. ')';

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($registerQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

/**
 * This function is designed to get the type of user
 * For the webapp, it will adapt the behavior of the GUI
 * @param $userEmailAddress
 * @return int (1 = customer ; 2 = seller)
 */
function getUserType($userEmailAddress){
    $result = 1;//we fix the result to 1 -> customer

    $strSeparator = '\'';

    $getUserTypeQuery = 'SELECT userType FROM users WHERE users.userEmailAddress =' . $strSeparator . $userEmailAddress . $strSeparator;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($getUserTypeQuery);

    if (count($queryResult) == 1){
        $result = $queryResult[0]['userType'];
    }
    return $result;
}

function addNewUser($code, $brand, $model, $snowLength, $qtyAvailable, $description, $dailyPrice, $photo ){
    $result = false;

    $strSeparator = '\'';

    // test de requete manuel pour debug
    // $addSnowQuery = "INSERT INTO snows (`code`, `brand`,`model`, `snowLength`,`qtyAvailable`, `description`,`dailyPrice`, `photo`,`active`) VALUES ('a','a','a','1','1','a','1','a','1')";

    $addUserQuery = 'INSERT INTO users (`id`, `userEmailAddress`,`userHashPsw`, `userType`) VALUES (' .$strSeparator . $User_id .$strSeparator . ',' . $strSeparator . $brand . $strSeparator. ',' .$strSeparator . $model . $strSeparator . ',' . $strSeparator . $snowLength . $strSeparator . ',' . $strSeparator . $qtyAvailable . $strSeparator. ',' . $strSeparator . $description .$strSeparator . ','. $strSeparator . $dailyPrice . $strSeparator . ',' . $strSeparator . $photo . $strSeparator . ',' . $strSeparator . '1' . $strSeparator . ')';

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addUserQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function deleteAUser($User_id)
{
    require_once 'model/dbConnector.php';
    $result = false;
    $strSeparator = '\'';
    $addUserQuery = 'DELETE FROM users WHERE (`id`) LIKE (' .$strSeparator . $User_id .$strSeparator.')';
    $queryResult = executeQuery($addUserQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function updateAUser($User_id, $UserEmail, $UserPsw, $Usertype){
    $result = false;

    $strSeparator = '\'';

    // test de requete manuel pour debug
    // $addSnowQuery = "INSERT INTO snows (`code`, `brand`,`model`, `snowLength`,`qtyAvailable`, `description`,`dailyPrice`, `photo`,`active`) VALUES ('a','a','a','1','1','a','1','a','1')";

    $updateSnowQuery = 'UPDATE users SET id= ' . $strSeparator . $User_id . $strSeparator
        . ', userEmailAddress=' . $strSeparator . $UserEmail . $strSeparator
        . ', userHashPsw=' . $strSeparator. $UserPsw .$strSeparator
        . ', userType=' . $strSeparator. $Usertype .$strSeparator
        .' WHERE id LIKE '.$strSeparator.$User_id.$strSeparator;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addUserQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}
