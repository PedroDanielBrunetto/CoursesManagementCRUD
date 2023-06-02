<?php 
    include "../database/database.php";

    if(!isset($_SESSION)){
        session_start();
    }

    try{
        if($_POST['nome'] == "" || $_POST['valor'] == "" || $_POST['horas'] == ""){
            throw new Exception ('Preencha todos os campos!');
        }
        else{
            $id = $_SESSION['user_id'];
            $sql="
            INSERT INTO courses
            (id_user, nm_course, hr_course, vl_course)
            VALUES (
                '{$id}',
                '{$_POST['nome']}',
                '{$_POST['valor']}',
                '{$_POST['horas']}'
                )
                ";
                $result = mysqli_query($conexao, $sql);
                if($result){
                    header('Location: ../newCourses.php');
                }
            else{
                throw new Exception ('Error!');
            }
        }
            }
            catch(Exception $ex){
                $_SESSION["Message"]="Exception found - ". $ex->getMessage();
                header ('Location: ../newCourses.php');
            }
                
                ?>