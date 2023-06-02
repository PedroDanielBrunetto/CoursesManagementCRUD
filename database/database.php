<?php
    $bdServidor = '127.0.0.1';
    $bdUsuario = 'root';
    $bdSenha = '';
    $bdBanco = 'db_curso';
    $conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

    session_start();
    try{
        if (!$conexao) {
            throw new Exception ('Problemas para conectar no banco. Verifique os dados!');
            die();
        }
        else{
            //echo "Conection OK!";
        }
    }
    catch (Exception $ex){
        $_SESSION["Message"]="Exception found - ". $ex->getMessage();
        header ('Location: ../index.php');
    }
?>
