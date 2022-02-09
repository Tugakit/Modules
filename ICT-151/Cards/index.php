<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 08:54
 * Update : feb 2022 A.MOTTIER
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
      case 'displaySnows' :
          displaySnows();
          break;
      case 'displayASnow' :
          displayASnow($_GET['code']);
          break;

      default :
          home();
  }
}
else {
    home();
}
