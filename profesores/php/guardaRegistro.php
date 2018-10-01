<?php
class persona {
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "encuentra_profesor";

    public function enviar(){
        try {
            $this -> conn = new PDO( "mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $password=$_POST['password'];

            $sql = $this->conn->prepare( "INSERT INTO alumno (,first_name,last_name, email, password) VALUES (:first_name, :last_name,  :email, :password);");
            $values = [,"first_name" => $first_name, "last_name" => $last_name, "email" => $email ,"password"=>$password];
            $sql->execute( $values );
            
            echo '<script>alert("Registrado! :\'v");parent.location = "Entro.html"</script>';
            sleep(1);
            exit();
        }
               catch(PDOException $ex)
            {
            echo $ex->getMessage();
                //echo $sql . "<br>" . $ex->getMessage();
            }
        $conn = null;
    }
}
$p1 = new persona();
$p1->enviar();
?>