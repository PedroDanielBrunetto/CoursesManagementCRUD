<?php 
    include "../database/database.php";

    if(!isset($_SESSION)){
        session_start();
    }

    try{
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if(empty($_POST['email'])||empty($_POST['password'])){
                throw new Exception ('empty fields!');
            }
        }

        $email = $_POST['email'];
        $senha = $_POST['password'];
    
        $result_user= "
            SELECT * FROM users WHERE nm_email = '$email'
        ";
        $user = mysqli_query($conexao, $result_user);
        if($user){
            $row_user = mysqli_fetch_array($user);
            if (password_verify($senha, $row_user['nm_password'])){
                $_SESSION['user_id'] = $row_user['id_user'];
                header('Location: ../newCourses.php');
            }
            else{
                $_SESSION['user_id']="";
                throw new Exception ('Email or Password is incorrect!');
            }
        }
    }
    catch(Exception $ex){
        $_SESSION["Message"]="Exception found - ". $ex->getMessage();
        header ('Location: ../index.php');
    }


?>