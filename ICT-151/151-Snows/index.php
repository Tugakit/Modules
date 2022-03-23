<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 08:54
 * Update : 31-JAN-2019 - nicolas.glassey
 *          Simplify index. Remove all pages references.
 */

session_start();
require "controler/controler.php";

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  switch ($action) {
      case 'home' :
          home();
          break;
      case 'login' :
          login($_POST);
          break;
      case 'logout' :
          logout();
          break;
      case 'register' :
          register($_POST);
          break;
      case 'displaySnows' :
          displaySnows();
          break;
      case 'displayASnow' :
          displayASnow($_GET['code']);
          break;
      case 'addSnow' :
          addSnow($_POST);
          break;
      case 'deleteSnow':
          deleteSnow($_GET['code']);
          break;
      case 'editSnow' :
          editSnow($_GET['code']);
          break;
      case 'updateSnow' :
          updateSnow($_POST);
          break;
      case 'displayUsers':
          displayUsers();
          break;
      case 'deleteUser':
          deleteUser($_GET['id']);
          break;
      case 'editUser':
          editUser($_GET['id']);
          break;
      case'updateUser':
          updateUser($_POST);
          break;
      case 'displayAUser':
          displayUser($_GET['id']);
          break;
      default :
          home();
  }
}

else {
    home();
}
