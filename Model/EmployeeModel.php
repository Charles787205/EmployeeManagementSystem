<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class EmployeeModel extends Database
{
    public function getEmployee($requestData)
    {   
        $query_string = "SELECT employee.*, department.name AS department FROM employee inner join department on employee.departmentId = department.id ";

        if(!empty($requestData)){
          $query_string .= ' WHERE ';
          
          foreach($requestData as $key => $value){
            if($key == 'email'){  
              $query_string .= 'employee.email = ? ';
              $stmt = $this->connection->prepare($query_string);
              $stmt->bind_param('s',  $value);

            }else if($key == 'departmentId'){  
              $query_string .= 'employee.departmentId = ? ';
              $stmt = $this->connection->prepare($query_string);
              $stmt->bind_param('i',  $value);
            }
            
            else{
              $query_string .= 'employee.id = ? ';
              $stmt = $this->connection->prepare($query_string);
              $stmt->bind_param('i', $value);
            }
          }
          $query_string .= " ORDER BY id DESC";
          $stmt->execute();
        }else{

          $query_string .= " ORDER BY id DESC";
          $stmt = $this->connection->prepare($query_string);
          $stmt->execute();
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
        
    
  }



    
    public function insertEmployee(Employee $employee) {
    $query = "INSERT INTO employee (email, birthdate, position, gender, mobileNumber, salaryRate, departmentId, firstName, lastName) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    try {
        // Check if the email already exists
        if ($this->isEmailExist($employee->getEmail())) {
            return false;
        }

        $email = $employee->getEmail();
        $birthdate = $employee->getBirthDate();
        $position = $employee->getPosition();
        $gender = $employee->getGender();
        $mobileNumber = $employee->getMobileNumber();
        $salaryRate = $employee->getSalaryRate();
        
        $departmentId = $employee->getDepartmentId();
        $firstName = $employee->getFirstName();
        $lastName = $employee->getLastName();

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sssssdiss',
            $email,
            $birthdate,
            $position,
            $gender,
            $mobileNumber,
            $salaryRate,
            $departmentId,
            $firstName,
            $lastName
        );

        $stmt->execute();
        return $stmt;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
  }

    public function updateEmployeeImage($employee){
      $query = 'UPDATE employee SET image=? WHERE id=?';
      $image = $employee->getImage();
      $stmt = $this->connection->prepare($query);
      $stmt->bind_param('si', $employee->getImage(), $employee->getId());
      $stmt->execute();
    }

    public function isEmailExist($email){
      return $this->select("SELECT email  FROM employee WHERE email='". $email ."'");
    }
    public function getEmployeeInDepartment($departmentId){
      return $this->select('SELECT * FROM employee WHERE departmentId='.$departmentId);
    }

    public function updateEmployee($employee){
    $query = "UPDATE employee SET email=?, birthdate=?, position=?, gender=?, mobileNumber=?, salaryRate=?, departmentId=?, firstName=?, lastName=? WHERE id=?";
      
    try {
        $email = $employee->getEmail();
        $birthdate = $employee->getBirthDate();
        $position = $employee->getPosition();
        $gender = $employee->getGender();
        $mobileNumber = $employee->getMobileNumber();
        $salaryRate = $employee->getSalaryRate();
        $departmentId = $employee->getDepartmentId();
        $firstName = $employee->getFirstName();
        $lastName = $employee->getLastName();
        $id = $employee->getId();
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sssssdissi', $email, $birthdate, $position, $gender, $mobileNumber, $salaryRate,  $departmentId, $firstName, $lastName, $id);

        $stmt->execute();
        return $stmt;
    } catch (mysqli_sql_exception $e) {
        // Handle the exception or log the error message
        throw new Exception('Error updating employee: ' . $e->getMessage());
    }
  }

  public function deleteEmployeeById($employeeId) {
      $query = "DELETE FROM employee WHERE id = ?";
      
      try {
          $stmt = $this->connection->prepare($query);
          $stmt->bind_param('i', $employeeId); // Assuming 'i' for integer
          
          $stmt->execute();
          return true; // Successful deletion
      } catch (mysqli_sql_exception $e) {
          // Handle the exception or log the error message
          return false; // Deletion failed
      }
  }



    
}