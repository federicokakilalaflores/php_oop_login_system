<?php

class User{
    
    // db table & connection
    private $table_name = "tbl_users";
    private $conn;

    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $contact_number;
    public $address;
    public $password;
    public $access_level;
    public $access_code;
    public $status;
    public $created;
    public $modified;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function emailExists(){

        $query = "SELECT id, firstname, lastname, access_level, password, status 
        FROM " . $this->table_name . " WHERE email = ?";   
        
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email)); 
        $stmt->bindParam(1, $this->email);
        $stmt->execute();  
        
        if($stmt->rowCount() > 0){

            $row = $stmt->fetch(PDO::FETCH_OBJ);

            $this->id = $row->id;
            $this->firstname = $row->firstname;
            $this->lastname = $row->lastname;
            $this->access_level = $row->access_level;
            $this->password = $row->password;
            $this->status = $row->status;

            return true;
        }   

        return false;

    } // end emailExist method

    public function isAccessCodeExists(){

        $query = "SELECT id FROM " . $this->table_name . " WHERE access_code=? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $this->access_code = htmlspecialchars(strip_tags($this->access_code));
        $stmt->bindParam(1, $this->access_code);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
        
    } // end isAccessCodeExist method

    public function store(){

        $query = "INSERT INTO " . $this->table_name . 
        "(firstname, lastname, email, contact_number, address, password, access_level, access_code, status, created)" . 
        "VALUES" . 
        "(:firstname, :lastname, :email, :contact_number, :address, :password, :access_level, :access_code, :status, :created)";

        $stmt = $this->conn->prepare($query);

        $this->created = date("Y-m-d H:i:s");
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->access_level = htmlspecialchars(strip_tags($this->access_level));
        $this->access_code = htmlspecialchars(strip_tags($this->access_code));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact_number", $this->contact_number);
        $stmt->bindParam(":address", $this->address);

        $password_encrypt = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $password_encrypt);

        $stmt->bindParam(":access_level", $this->access_level);
        $stmt->bindParam(":access_code", $this->access_code);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created", $this->created);

        if($stmt->execute()){
            return true;
        }

        $this->showSqlError($stmt);
        return false;

    } // end store method

    public function updateStatusByAccessCode(){

        $query = "UPDATE " . $this->table_name . " 
        SET status = :status
        WHERE access_code = :access_code";
        
        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->access_code = htmlspecialchars(strip_tags($this->access_code)); 

        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":access_code", $this->access_code);

        if($stmt->execute()){
            return true; 
        }

        return false;
 
    } // end updateStatusByAccessCode method

    public function updatePasswordByAccessCode(){
        $query = "UPDATE " . $this->table_name . "  
        SET password = :password
        WHERE access_code = :access_code";

        $stmt = $this->conn->prepare($query);

        $this->password = htmlspecialchars(strip_tags($this->password)); 
        $this->access_code = htmlspecialchars(strip_tags($this->access_code)); 

        $password_encrypt = password_hash($this->password, PASSWORD_BCRYPT);

        $stmt->bindParam(":password", $password_encrypt);
        $stmt->bindParam(":access_code", $this->access_code);

        if($stmt->execute()){
            return true; 
        }
        
        return false;
    
    } // end updatePasswordByAccessCode method

    public function updateAccessCode(){ 

        $query = "UPDATE " . $this->table_name . " 
        SET access_code = :access_code
        WHERE email = :email";

        $stmt = $this->conn->prepare($query);

        $this->access_code = htmlspecialchars(strip_tags($this->access_code));
        $this->email = htmlspecialchars(strip_tags($this->email)); 

        $stmt->bindParam(":access_code", $this->access_code);
        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()){
            return true;
        }

        return false;

    }

    public function read($page_start_num, $records_per_page){
        $query = "SELECT firstname, lastname, email, contact_number, access_level 
        FROM " . $this->table_name . 
        " ORDER BY firstname ASC LIMIT " . $page_start_num . "," . $records_per_page;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    } // end read method

    public function countAll(){
        $query = "SELECT id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    } //end countAll 


    public function showSqlError($stmt){
        echo "<pre>";
        print_r($stmt->errorInfo);
        echo "</pre>";
    } // end showsqlError method


}