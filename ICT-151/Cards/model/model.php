<?php

function openDBConnexion (){
    $tempDbConnexion = null;
    $sqlDriver = 'mysql';
    $hostname = 'localhost';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'snows';
    $userName = 'root';
    $userPwd = '1234';
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try{
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    }
    catch (PDOException $exception) {
        echo 'Connection failed: ' . $exception->getMessage();
    }
    return $tempDbConnexion;
}


function executeQuerySelect($query){
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null)
    {
        $statement = $dbConnexion->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll();//prepare result for client
    }
    $dbConnexion = null;//close database connexion
    return $queryResult;
}


function getSnows(){
    $snowsQuery = 'SELECT code, brand, model, snowLength, dailyPrice, qtyAvailable, photo, active FROM snows';

    $snowResults = executeQuerySelect($snowsQuery);

    return $snowResults;
}

