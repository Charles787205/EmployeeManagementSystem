<?php
class EmployeeController extends BaseController
{
    /** 
* "/user/list" Endpoint - Get list of users 
*/
    public function listAction()
{
    $strErrorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $arrQueryStringParams = $this->getQueryStringParams();

    try {
        $employeeModel = new EmployeeModel();
        


        $arrEmployee = $employeeModel->getEmployee($_GET);
        $responseData = json_encode($arrEmployee);
    } catch (Error $e) {
        $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
        $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
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

    
    public function postAction(){
        $requestData = file_get_contents('php://input');
        
        $data = json_decode($requestData, true);
      
       
        $employee = new Employee();
        
        $employee->setName( $data['firstName'] , $data['lastName']);
        $employee->setEmail($data['email']);
        $employee->setPosition($data['position']);
        $employee->setGender($data['gender']);
        $employee->setDepartmentId($data['departmentId']);
        $employee->setMobileNumber($data['mobileNumber']);
        $employee->setSalaryRate($data['salaryRate']);
        $employee->setPassword($data['password']);
        $employee->setBirthDate($data['birthDate']);

        
        header('Access-Control-Allow-Origin: *'); // Replace * with the specific origin you want to allow.
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-Type: application/json');

        $employeeModel = new EmployeeModel();
        if($employeeModel -> insertEmployee($employee)){
          $this->sendOutput(
            $employee->toJson()
          );

        }else{
            header("HTTP/1.1 500 Email Already Registered");
            
        }
    }

    public function updateAction(){
      $requestData = file_get_contents('php://input');
        
        $data = json_decode($requestData, true);
      
       
        $employee = new Employee();
        
        $employee->setId( $data['id']);
        $employee->setFirstName( $data['firstName']);
        $employee->setLastName($data['lastName']);
        $employee->setEmail($data['email']);
        $employee->setPosition($data['position']);
        $employee->setGender($data['gender']);
        $employee->setDepartmentId($data['departmentId']);
        $employee->setMobileNumber($data['mobileNumber']);
        $employee->setSalaryRate($data['salaryRate']);
        $employee->setPassword($data['password']);
        $employee->setBirthDate($data['birthDate']);

        
        header('Access-Control-Allow-Origin: *'); // Replace * with the specific origin you want to allow.
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Content-Type: application/json');

        $employeeModel = new EmployeeModel();
        if($employeeModel -> updateEmployee($employee)){
          $this->sendOutput(
            $employee->toJson()
          );

        }else{
            header("HTTP/1.1 500 Email Already Registered");
        }
    }

    public function deleteAction(){
      $requestData = file_get_contents('php://input');
      $data = json_decode($requestData, true);
      $employeeModel = new EmployeeModel();
      header('Access-Control-Allow-Origin: *'); // Replace * with the 
      header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Content-Type: application/json');

      $isDeleted = $employeeModel->deleteEmployeeById($data['id']);
      if($isDeleted){
        $this->sendOutput(
            json_encode("successful")
          );
      }else{
        header("HTTP/1.1 500 Error");
      }
    }
  
}