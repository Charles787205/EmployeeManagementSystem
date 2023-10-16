<?php 
 class Employee {
  private $id, $firstName, $lastName, $birthDate, $position, $gender, $mobileNumber, $salaryRate, $password, $departmentId, $department, $email;

  
  public function setId($id){
    $this-> id = $id;
  }

  public function setName($firstName, $lastName){
    $this -> firstName = $firstName;
    $this -> lastName = $lastName;
  }
  public function setFirstName($firstName){
    $this -> firstName = $firstName;
  }
  public function setLastName($lastName){
    $this -> lastName = $lastName;
  }

  public function setBirthDate($birthDate){
    $this -> birthDate = $birthDate;
  }
  public function setPosition($position){
    $this-> position = $position;
  }
  public function setGender($gender){
    $this-> gender = $gender;
  }
  public function setMobileNumber($mobileNumber){
    $this -> mobileNumber = $mobileNumber;
  }
  public function setSalaryRate($salaryRate){
    $this -> salaryRate = $salaryRate;
  }
  public function setPassword($password){
    $this -> password = $password;
  }
  public function setDepartmentId($id){
    $this -> departmentId = $id;
  }
  public function setDepartment($department){
    $this->department = $department;
  }
  public function setEmail($email){
    $this->email = $email;
  }

  public function getId(){
    return $this->id;
  }
  public function getFirstName(){
    return $this -> firstName;
  }
  public function getLastName(){
    return $this-> lastName;
  }
  public function getName() {
    return $this->firstName .' '.$this->lastName;
  }
  public function getBirthDate(){
    
    return strval($this->birthDate);
  }
  public function getPosition(){
    return $this->position;
  }
  public function getGender(){
    return $this->gender;
  }
  public function getMobileNumber(){
    return $this->mobileNumber;
  }
  public function getSalaryRate(){
    return $this->salaryRate;
  }
  public function getPassword(){
    return $this->password;
  }
  public function getDepartmentId(){
    return $this->departmentId;
  }
  public function getDepartment(){
    return $this->department;
  }
  public function getEmail(){
    return $this->email;
  }
  public function toJson() {
        return json_encode([
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'birthDate' => $this->getBirthDate(),
            'position' => $this->getPosition(),
            'gender' => $this->getGender(),
            'mobileNumber' => $this->getMobileNumber(),
            'salaryRate' => $this->getSalaryRate(),
            'password' => $this->getPassword(),
            'departmentId' => $this->getDepartmentId(),
            'department' => $this->getDepartment(),
            'email' => $this->getEmail()
        ]);
    }
 }