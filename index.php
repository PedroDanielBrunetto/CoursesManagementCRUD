      <?php
        include "database/database.php";

        //Verifico se a pagina foi carregada, assim declarando o id como 0, impossibilitando de entrar na proximas pages
        if ($_SERVER['REQUEST_METHOD']==='GET'){
          $_SESSION['user_id']="";
      }
  
        $list = courses($conexao);
        function courses($conexao)
        {
        $sqlBusca = '
        SELECT * FROM courses
        ';
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
    <link rel="stylesheet" href="style/index.css">
    <title>CRUD - Courses</title>
</head>
<style>
    * {
        font-family: 'Poppins', sans-serif;
    }
</style>
<body>

    <div class="container">
        <div class="buttonsForm">
          <div class="btnColor"></div>
          <button id="btnSignin">Login</button>
          <button id="btnSignup">Cadastro</button>
        </div>
    
        <form name="login" action="user-management/login.php" method="post" id="signin">
          <input type="email" name="email" placeholder="Email" required />
          <i class="fas fa-envelope iEmail"></i>
          <input type="password" name="password" placeholder="Senha" required />
          <i class="fas fa-lock iPassword"></i>
    
          <?php 
            if(!isset($_SESSION)){
              session_start();
          }
            if(isset($_SESSION["Message"])){
              echo $_SESSION["Message"];
              unset($_SESSION["Message"]);
            }
          ?>
    
          <button type="submit">Entrar</button>
        </form>
    
        <form name="register" action="user-management/register.php" method="post" id="signup">
          <input type="email" placeholder="Email" name="email" required />
          <i class="fas fa-envelope iEmail"></i>
          <input type="password" name="password1" placeholder="Senha" required />
          <i class="fas fa-lock iPassword"></i>
          <input type="password" name="password2" placeholder="Confirme a senha" required />
          <i class="fas fa-lock iPassword2"></i> 
          <button type="submit">Registre-se</button>
        </form>
    </div>
    
    <div class="tabela">
      <?php
                if ($list->num_rows > 0) {
                  echo "<h2>Cursos disponíveis!</h2>";
                  while($dado = $list->fetch_assoc()) { 
                    ?>
                            <table>
                            <tbody>
                            <tr>
                            <td><?php echo $dado['nm_course'];?></td>
                            <td>R$ <?php echo $dado['hr_course'];?></td>
                            <td><?php echo $dado['vl_course'];?> Horas</td>
                            </tr>
                      <?php                        
                      }
                      }        
                      else{
                        echo "<h2>Não tem cursos disponíveis!</h2>";
                      }          
                ?>
          </tbody>
        </table>
    </div>

</body>
<script src="style/style.js"></script>
</html>
<?php 
//COPYRIGHT PEDRO DANIEL BRUNETTO
?>