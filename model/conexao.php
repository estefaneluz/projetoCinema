<?php 

    session_start();

    class dataBase  {
        private $userName="root";
        private $senha ="";
       
        public $conn; 
        public function dbConnection(){
            $this->conn = null; 
            try { 
                $this->conn=new PDO('mysql:host=localhost; dbname=Cinemail', $this->userName, $this->senha);
                $this->conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $this->conn;
        }
    }   

?>