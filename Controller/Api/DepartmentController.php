<?php

class DepartmentController extends BaseController {

  public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $departmentModel = new DepartmentModel();
                
                $arrDepartments = $departmentModel->getDepartments();
                $responseData = json_encode($arrDepartments);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


  public function postAction() {
    $responseData = file_get_contents('php://input');
    $postData = json_decode($responseData, true);
    $department = new Department();
    $departmentModel = new DepartmentModel();
    
    if(isset($postData['name'])){
      $department->setName($postData['name']);

      $response = $departmentModel->insertDepartment($department->getName());
    };
    
    header('Access-Control-Allow-Origin: *'); // Replace * with the specific origin you want to allow.
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');    
    header('Content-Type: application/json');
    
    $this->sendOutput(json_encode($response));
}
  public function deleteFunction(){
      $requestData = file_get_contents('php://input');
      $data = json_decode($requestData, true);
      $departmentModel = new DepartmentModel();
      header('Access-Control-Allow-Origin: *'); // Replace * with the 
      header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Content-Type: application/json');

      $isDeleted = $departmentModel->deleteDepartmentById($data['id']);
      if($isDeleted){
        $this->sendOutput(
            json_encode("successful")
          );
      }else{
        header("HTTP/1.1 500 Error");
      }
    }
}