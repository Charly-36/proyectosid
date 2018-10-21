<?php
class persona {
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "bdprofesores";

    public function registrar(){
        try {
            $this -> conn = new PDO( "mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];
            $pass=$_POST['password'];
            
            $buscar = $this->conn->prepare("SELECT * FROM alumno WHERE email='$email'");//buscar si el usuario existe
            $buscar->execute();
            $resultado = $buscar->fetch(PDO::FETCH_ASSOC);
            if($resultado!=null){//Si se encuentran los datos
                echo '<script>alert("Correo en uso, intenta con otro diferente");parent.location = "../registro_alumno.html"</script>';
            }
            else{//No se deja entrar si los datos son incorrectos
            $sql = $this->conn->prepare( "INSERT INTO alumno (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password);");
            $values = ["first_name" => $first_name, "last_name" => $last_name, "email" => $email ,"password"=>$pass];
            $sql->execute( $values );
    
            //echo '<script>alert("Registrado! :\'v");parent.location = "Entro.html"</script>';
            echo '<script>alert("Su registro se ha llevado con éxito!");parent.location = "../Home.html"</script>';
            sleep(3);
            exit();
            }            
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            }
        $conn = null;
    }
}
$p1 = new persona();
    $p1->registrar();
?>