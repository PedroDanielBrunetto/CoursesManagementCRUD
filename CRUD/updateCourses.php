<?php 
    include "../database/database.php";

    try{
        if($_POST['nome'] == "" || $_POST['valor'] == "" || $_POST['hora'] == ""){
            throw new Exception ('Preencha todos os campos!');
        }
        else{
            function atualizar($conexao){
                $sql="
                UPDATE courses
                SET 
                nm_course = '{$_POST['nome']}',
                hr_course = '{$_POST['hora']}',
                vl_course = '{$_POST['valor']}'    
                WHERE
                id_course = '{$_POST['id']}'
                ";
                return mysqli_query($conexao, $sql);
            }
            }
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if (atualizar($conexao)){
                header('Location: ../editCourses.php');
            }
            else {
                throw new Exception ('Error na atualizacao');
            }
        }
        else {
            header('Location: ../editCourses.php');
        }
    }
    catch(Exception $ex){
        $_SESSION["Message"]="Exception found - ". $ex->getMessage();
        header ('Location: ../editCourses.php');
    }
            ?>