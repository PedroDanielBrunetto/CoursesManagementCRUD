<?php
        include "database/database.php";

        if(isset($_GET['id'])){
            //$id_=$_GET['id'];
            $sql="
            SELECT * FROM courses WHERE id_course = '{$_GET['id']}'
            ";
            $result=mysqli_query($conexao, $sql); 
        
        while($dado = $result->fetch_assoc()) { 
            $id = $dado['id_course']; 
            $nome = $dado['nm_course'];
            $hour = $dado['hr_course'];      
            $value= $dado['vl_course']; 
            //tem duas chaves para fechar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/newCourse.css">
    <title>Edit - Courses</title>
</head>
<style>
    * {
        font-family: 'Poppins', sans-serif;
    }
</style>
<body>
    <div class="container">
        <h2>Atualizar dados</h2>
        <form action="CRUD/updateCourses.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"><br>
            <label for="nome">Curso: </label>
            <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
            <label for="hora">Valor: </label>
            <input type="text" name="hora" value="<?php echo $hour; ?>"><br>
            <label for="valor">Duração: </label>
            <input type="text" name="valor" value="<?php echo $value; ?>"><br>

            <?php 
                if(isset($_SESSION["Message"])){
                echo $_SESSION["Message"];
                unset($_SESSION["Message"]);
                }
            ?>
            
            <input type="submit" value="Atualizar" name="update">
        </form>
    <?php
    } //Fecha o while
    } //Fecha o if
    else {
        header('Location: newCourses.php');
    }
    ?>
    </div>
</body>
</html>