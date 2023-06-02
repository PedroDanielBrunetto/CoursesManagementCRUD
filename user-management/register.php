<?php
    include "../database/database.php";

    if(!isset($_SESSION)){
        session_start();
    }
    try{
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if (register($conexao)){
                header('Location: ../index.php');
            }
        } 
    }
    catch (Exception $ex){
        $_SESSION["Message"]="Exception found - ". $ex->getMessage();
        header ('Location: ../index.php');
    }

    function register($conexao){

        $password = $_POST['password1'];
        $verifypass = $_POST['password2'];
        $email = $_POST['email'];

        try{
            $verifyemail = " 
                           SELECT nm_email FROM users 
                           WHERE nm_email = '{$email}'
                           ";
            // mysqli_query contém os resultados da consulta SQL executada
            $result = mysqli_query($conexao, $verifyemail);
            // mysqli_fetch_assoc deve obter a próxima linha de um resultado de consulta SQL como um array associativo.
            $row = mysqli_fetch_assoc($result); //entao ele pega o $result e vai verificando as linhas, ou seja, quando o $result bater, vai ficar armazenado na $row

            if ($row) {
                throw new Exception('Email exists!');
            }
            else{

                if($email != $verifyemail){
                    if($password != $verifypass && filter_var($email, FILTER_VALIDATE_EMAIL)){
                        throw new Exception ('Password or Email is invalid!');
                    }
                    else{
                        $hashpass = trim(password_hash($password, PASSWORD_DEFAULT));
                        
                        $sql="
                        INSERT INTO users
                        (nm_email, nm_password)
                        VALUES (
                            '{$email}',
                            '{$hashpass}'
                            )
                            ";
                            return mysqli_query($conexao, $sql);
                        }
                    }

                }

        }
        catch (Exception $ex){
            $_SESSION["Message"]="Exception found - ". $ex->getMessage();
            header ('Location: ../index.php');
        }
    }
?>