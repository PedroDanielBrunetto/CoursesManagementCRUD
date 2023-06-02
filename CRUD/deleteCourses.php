<?php
include "../database/database.php";

if (isset($_GET['id'])){
    if (deletar($conexao)){
        header('Location: ../newCourses.php');
    }
    else {
        echo "Erro na exclusão";
    }
}
else {
    header('Location: ../newCourses.php');
}
function deletar($conexao){
    $sql="
    DELETE FROM courses    
    WHERE
    id_course = '{$_GET['id']}'
    ";
    return mysqli_query($conexao, $sql);
}
?>