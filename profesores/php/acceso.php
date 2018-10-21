<?php
class persona {
    
    public function login(){
        try{
        $email=$_POST['email']; /// recibo login (matrícula)
        $pass=$_POST['password']; // recibo contraseña

        $basededatos = new PDO('mysql:host=localhost;dbname=bdprofesores', 'root', '');
        $consulta = $basededatos->prepare("SELECT * FROM alumno WHERE email='$email' and password='$pass'");//buscar usuario y contraseña en la base de datos
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if($resultado!=null){//Si se encuentran los datos
        $id=$resultado['id_alumno']; // guardar ID del usuario
        $name=$resultado['first_name'];//guardar el nombre de usuario
        $last_name=$resultado['last_name'];//Guarda apellido
            echo '<script>parent.location = "../Home.html"</script>';
        }
    else{//No se deja entrar si los datos son incorrectos
        echo '<script>alert("Correo o contraseña incorrecta");parent.location = "../inicio_sesion.html"</script>';
    }
   }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
  }
    
}
$p1 = new persona();
$p1->login();
?>