<?php

class DepartmentModel extends Database
{
    public function getDepartments()
    {
        return $this->select("SELECT * FROM department  ORDER BY id DESC");
    }


    public function insertDepartment(string $departmentName) {
    $query = "INSERT INTO department (name) VALUES (?)";
    try {
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('s', $departmentName);
        $stmt->execute();
        return $stmt;
    } catch (Exception $e) {
        // Handle the exception or log the error message
        throw new Exception('Error inserting department: ' . $e->getMessage());
    }
}
  public function deleteDepartmentById($departmentId) {
      $query = "DELETE FROM department WHERE id = ?";
      
      try {
          $stmt = $this->connection->prepare($query);
          $stmt->bind_param('i', $departmentId); // Assuming 'i' for integer
          
          $stmt->execute();
          return true; // Successful deletion
      } catch (mysqli_sql_exception $e) {
          // Handle the exception or log the error message
          return false; // Deletion failed
      }
  }

    
}