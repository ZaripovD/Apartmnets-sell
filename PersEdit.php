<!DOCTYPE html>
<title>Личный кабинет</title>

<?php include("includes/session.php");
include("includes/sidebar.php"); 

if (isset($data['change'])) { 
  $sql = mysqli_query($connection, "UPDATE user SET Name = '{$data['name']}', Family = '{$data['family']}', Father = '{$data['father']}', phone = '{$data['phone']}', mail = '{$data['email']}' WHERE login = '{$_SESSION['logged_user']->login}'");
  if ($sql){
    echo "<div class='row text-center'><h4>Изменения войдут в силу после перезахода в аккаунт</h4></div>";
  }
  else{
    echo mysqli_error($connection);
  }
}

 ?>

<div class="container-fluid" >
      

     <section id="description">
      <div class="container">
      <form action="PersEdit.php" method="POST" class="n" >        
        <div class="text-center">
            <h1>Личная карточка</h1>
            <div class="col-md-1 col-md-offset-11">
          <a href="PersArea.php">Назад, пока без обновлений</a>
      </div>
          </div>

        <div class="row" id="scooter">
          <div class="col-md-2 col-md-offset-1">
      </div>
          <div class="col-md-3 col-md-offset-1">
            <h3>Фамилия:</h3>
            <input type="text" value="<?php echo $_SESSION['logged_user']->Family; ?>" name="family">
            <h3>Имя:</h3>
            <input type="text" value="<?php echo $_SESSION['logged_user']->Name; ?>" name="name">
            <h3>Отчество:</h3>
            <input type="text" value="<?php echo $_SESSION['logged_user']->Father; ?>" name="father">
            </p><br>
          </div>
          <div class="col-md-3 col-md-offset-1">            
            <h3>Номер телефона:</h3>
            <input type="" value="<?php echo $_SESSION['logged_user']->phone; ?>" name="phone">           
          </div>
          <div class="col-md-3 col-md-offset-1">
            <h3>Электронная почта:</h3>
            <input type="text" value="<?php echo $_SESSION['logged_user']->mail; ?>" name="email">            
          </div>
          <div class="col-md-3 col-md-offset-1"><br>
            <button type="submit" name="change">Изменить</button>
          </div>
          </form>        
    </div>
 
    </section>
</div>

 <?php include("includes/footer.php"); ?>