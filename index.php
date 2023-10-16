<?php

error_reporting(E_ALL); ini_set('display_errors', 1);
require __DIR__ . "/inc/bootstrap.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode( '/', $uri );
require PROJECT_ROOT_PATH . "/Objects/Employee.php";


require PROJECT_ROOT_PATH . "/Controller/Api/EmployeeController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/DepartmentController.php";
if ((isset($uri[3]) && $uri[3] == 'employee') && isset($uri[4])) {
   
    $objFeedController = new EmployeeController();
    $strMethodName = $uri[4] . 'Action';
    $objFeedController->{$strMethodName}();

    exit();
}else if((isset($uri[3]) && $uri[3] =='department') && isset($uri[4])){
  
  $objFeedController = new DepartmentController();
  $strMethodName = $uri[4] . 'Action';
  $objFeedController->{$strMethodName}();
  exit();
}


?>