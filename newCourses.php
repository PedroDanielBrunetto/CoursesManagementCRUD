<?php
        include "database/database.php";
        if(!isset($_SESSION)){
            session_start();
        }
        try{
            if ($_SESSION['user_id'] == "") {
                throw new Exception ('ACESSO RESTRITO');
            }
        }
                catch(Exception $ex){
            $_SESSION["Message"]="Exception found - ". $ex->getMessage();
            header('Location: index.php');
            exit(); 
        }

        $list = courses($conexao);
            function courses($conexao)
            {
                $id = $_SESSION['user_id'];
                $sqlBusca = "
                SELECT * FROM courses WHERE id_user = '$id'
                ";
                $resultado = mysqli_query($conexao, $sqlBusca);
                return $resultado;
            }
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
        <title>Add - Courses</title>
    </head>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        </style>
<body>
    <div class="column">
        <div class="container">
            <form action="CRUD/createCourses.php" method="post">
                <?php
                echo "Seu id: ".$_SESSION['user_id'];
                ?>
                <h3>Cadastrar novos cursos</h3>
                <label>Nome do Curso</label>
                <input type="text" placeholder="Ex: 'JavaScript Easy'" name="nome">
            <label>Horas</label>
            <input type="text" placeholder="Ex: '40'" name="horas">
            <label>Valor</label>
            <input type="text" placeholder="R$" name="valor">
            <?php 
                if(isset($_SESSION["Message"])){
                    echo $_SESSION["Message"];
                    unset($_SESSION["Message"]);
                }
                ?>

<input type="submit" value="Create">
<a href="index.php">SAIR</a>
</form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th><th>Nome</th><th>Valor</th><th>Duração</th>
        </tr>      
    </thead>
    <tbody>
        <?php
            if ($list->num_rows > 0) {
                while($dado = $list->fetch_assoc()) { 
                    ?>
                        <tr>
                            <td><?php echo $dado['id_course'];?></td>
                            <td><?php echo $dado['nm_course'];?></td>
                            <td>R$ <?php echo $dado['hr_course'];?></td>
                            <td><?php echo $dado['vl_course'];?> Horas</td>
                            <td><a class="edit" href="editCourses.php?id=<?php echo $dado['id_course'];?>">Editar</a>&nbsp;<a class="delete" href="CRUD/deleteCourses.php?id=<?php echo $dado['id_course'];?>">Apagar</a></td>                        
                        </tr>
                        <?php                        
                  }
                }                  
                ?>
      </tbody>
    </table>
</div>
</body>
</html>